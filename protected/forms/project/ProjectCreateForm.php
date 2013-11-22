<?php

/**
 * Class ProjectCreateForm
 */
class ProjectCreateForm extends ProjectForm
{
    /**
     * Save
     *
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            /** @var WebUser $user */
            $user = Yii::app()->user;

            // save a project
            $this->model->name = $this->name;
            $this->model->status = $this->status;
            $this->model->description = $this->description;
            $this->model->service_id = $this->service_id;
            $this->model->save();

            // save create & update time
            $time = time();
            $this->model->setMeta('create_time', $time);
            $this->model->setMeta('update_time', $time);

            // save expected start time
            $this->model->setMeta(
                'expected_start_time',
                CDateTimeParser::parse($this->expected_start_time, 'MM/dd/yyyy')
            );

            // save expected finish time
            $this->model->setMeta(
                'expected_finish_time',
                CDateTimeParser::parse($this->expected_finish_time, 'MM/dd/yyyy')
            );

            // save actual start time
            if ($this->actual_start_time && !$user->isCustomer)
                $this->model->setMeta(
                    'actual_start_time',
                    CDateTimeParser::parse($this->actual_start_time, 'MM/dd/yyyy')
                );

            // save actual finish time
            if ($this->actual_finish_time && !$user->isCustomer)
                $this->model->setMeta(
                    'actual_finish_time',
                    CDateTimeParser::parse($this->actual_finish_time, 'MM/dd/yyyy')
                );

            // save customers
            if ($this->customers && !$user->isCustomer) {
                foreach ($this->customers as $customerId) {
                    $customer = CustomerModel::model()->findByPk($customerId);
                    if (null === $customer) continue;

                    $this->model->setUser($customer->id);
                }
            }

            // save members
            if ($this->members && !$user->isCustomer && !$user->isMember) {
                foreach ($this->members as $memberId) {
                    $member = MemberModel::model()->findByPk($memberId);
                    if (null === $member) continue;

                    $this->model->setUser($member->id);
                }
            }

            // managers
            if ($this->managers && !$user->isCustomer && !$user->isMember && !$user->isManager) {
                foreach ($this->managers as $managerId) {
                    $manager = ManagerModel::model()->findByPk($managerId);
                    if (null === $manager) continue;

                    $this->model->setUser($manager->id);
                }
            }

            // price
            if (!$user->isMember)
                $this->model->setMeta('price', $this->price);

            // set current customer
            if ($user->isCustomer)
                $this->model->setUser($user->id);

            // upload
            if (!$user->isCustomer)
                $this->upload();

            // set project id
            $this->id = $this->model->id;
            return true;
        } else
            return false;
    }
}