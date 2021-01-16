<?php
namespace Levinc\AssignCoupon\Ui\DataProvider;

class CouponDataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    public function getData()
    {
        $data = parent::getData();
        foreach ($data['items'] as $key=>$item) {
            if ($item['times_used'] !== "0") {
                unset($data['items'][$key]);
                $data['totalRecords']--;
            }
        }

        $items_values = array_values($data['items']);
        $data['items'] = $items_values;
        return $data;
    }
}
