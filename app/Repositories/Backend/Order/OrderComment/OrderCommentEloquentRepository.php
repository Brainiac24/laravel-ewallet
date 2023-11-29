<?php
namespace App\Repositories\Backend\Order\OrderComment;


use App\Models\Order\OrderComments\OrderComments;
use App\Services\Common\Helpers\OrderType;

class OrderCommentEloquentRepository implements OrderCommentRepositoryContract
{
    /**
     * @var OrderComments
     */
    private $orderComments;

    public function __construct(OrderComments $orderComments)
    {
        $this->orderComments = $orderComments;
    }

    public function getAll($search)
    {
        return $this->orderComments->where('name', 'like', '%' . $search . '%')->with('order_type')->orderBy('name')->get();
    }

    public function findById($id)
    {
        return $this->orderComments->where('id', $id)->first();
    }

    public function isActiveList()
    {
        return $this->orderComments
            ->whereNotIn('id', [
                "f877fc3b-0dd9-11eb-b655-e386f22e0db6",
                "08feb39f-0dda-11eb-b655-e386f22e0db6",
                "192ead3d-0dda-11eb-b655-e386f22e0db6",
                "27b019aa-0dda-11eb-b655-e386f22e0db6",
                "41ab6996-0dda-11eb-b655-e386f22e0db6",
                "1c88a8eb-b107-4a67-a3f7-35874706ce60",
            ])
            ->where('code','!=','call')
            ->isActive()
            ->with('order_type')
            ->orderBy('name')
            ->get()
            ->pluck('short_name', 'id');
    }

    public function commentCallRemoteIdentificationList()
    {
        return $this->orderComments
            ->where('order_type_id', OrderType::REMOTE_IDENTIFICATION)
            ->where('code','call')
            ->isActive()
            ->with('order_type')
            ->orderBy('name')
            ->get()
            ->pluck('short_name', 'id');
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->orderComments->select($columns)->orderBy('created_at', 'desc')->with('order_type')->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $orderComment = $this->orderComments->findOrFail($id);
        $orderComment->setOldAttributes($orderComment->getAttributes());
        $orderComment->update($data);
        return $orderComment;
    }

    public function create(array $data)
    {
        return $this->orderComments->create($data);
    }
}