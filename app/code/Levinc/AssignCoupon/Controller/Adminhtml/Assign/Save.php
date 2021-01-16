<?php

namespace Levinc\AssignCoupon\Controller\Adminhtml\Assign;

class Save extends \Levinc\AssignCoupon\Controller\Adminhtml\Assign
{
    private $lengthArr;
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            $data = $this->getRequest()->getPostValue();
            try {
                // get randomed data
                $data = $this->prepareData($data);

                // save multiple model
                $transaction = $this->transactionFactory->create();
                foreach ($data as $item) {
                    $tableInstance = $this->personalCouponFactory->create();
                    $tableInstance->setCustomerId($item['customer_id']);
                    $tableInstance->setCouponId($item['coupon_id']);
                    $transaction->addObject($tableInstance);
                }
                $transaction->save();

                $this->getMessageManager()->addSuccessMessage(__('You saved the widget.'));
                $this->_redirect('*/*/');

                return;
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->getMessageManager()->addErrorMessage($e->getMessage());

                $this->_redirect('*/*/create');
                return;
            } catch (\Exception $e) {
                $this->getMessageManager()->addErrorMessage(
                    __('Something went wrong while saving the item data.')
                );
                $this->_redirect('*/*/create');

                return;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * @param array $data
     * @return array
     */
    public function prepareData(array $data)
    {
        $result = [];
        $customerData = $this->randomArray($data['customer_selection']['customer_container']);
        $couponData = $this->randomArray($data['coupon_selection']['coupon_container']);

        for ($i = 0; $i < $this->lengthArr; $i++) {
            $result[] = [
                'customer_id' => $customerData[$i]['entity_id'],
                'coupon_id' => $couponData[$i]['coupon_id']
            ];
        }
        return $result;
    }

    public function randomArray($arr)
    {
        $length = count($arr);
        if (empty($this->lengthArr)) {
            $this->lengthArr = $length;
        } else {
            if ($length < $this->lengthArr) {
                $this->lengthArr = $length;
            }
        }
        shuffle($arr);
        return $arr;
    }
}
