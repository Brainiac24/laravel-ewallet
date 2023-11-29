<?php

namespace App\Repositories\Backend\Order\RemoteIdentification;


use App\Models\Order\Filters\OrderFilter;
use App\Models\Order\Order;
use App\Repositories\Backend\Order\OrderComment\OrderCommentRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use Carbon\Carbon;

class RemoteIdentificationEloquentRepository implements RemoteIdentificationRepositoryContract
{

    /**
     * @var Order
     */
    private $order;
    private $userRepository;
    private $orderCommentRepository;

    public function __construct(Order $order, UserRepositoryContract $userRepository, OrderCommentRepositoryContract $orderCommentRepository)
    {
        $this->order = $order;
        $this->userRepository = $userRepository;
        $this->orderCommentRepository = $orderCommentRepository;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->order->select($columns)
            ->with('order_status','order_process_status','from_user','from_user.attestation','updated_by_user','processed_by_user')
            ->isRemoteIdentification()
            ->filterBy(new OrderFilter($data))->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        $order=$this->order->with('from_user', 'to_user', 'order_type', 'order_status')->where('id', $id)->first();
        if (isset($order) && isset($order->payload_params_json['history']['calls'])){
            $usersId=[];
            $orderCommentsId=[];
            $data=$order->payload_params_json['history']['calls'];
            foreach ($data as $key=>$item) {
                if (isset($item['user_id'])){
                    $user=null;
                    try{
                        $user=$this->userRepository->findById($item['user_id']);
                    }catch (\Exception $ex){
                        $user=null;
                    }
                    $userFullName='';
                    if (isset($user)){
                        $userFullName=$user->full_name_extended_format??'';
                    }
                    $data[$key]['user_id']=$userFullName;
                }
                if (isset($item['order_comment_id'])){
                    $orderComment=$this->orderCommentRepository->findById($item['order_comment_id']);
                    $orderCommentShortName='';
                    if (isset($orderComment) && isset($orderComment->short_name)){
                        $orderCommentShortName=$orderComment->short_name??'';
                    }
                    $data[$key]['order_comment_id']=$orderCommentShortName;
                }
                if (isset($item['date'])){
                    $data[$key]['date']=Carbon::parse($item['date'])->format('d-m-Y H:i:s');
                }
            }

            $order->history_call=$data;
        }
        return $order;
    }

    public function findByIdToTake($id){
        return $this->order->with('from_user', 'to_user', 'order_type', 'order_status')->where('id', $id)->first();
    }

}