<?php

/**
 * Class ProjectUpdateForm
 *
 * @property ProjectModel $model
 */
class ProjectUpdateForm extends ProjectForm
{
    /**
     * Populate form
     */
    public function populate()
    {
        // project info
        $this->name = $this->model->name;
        $this->status = $this->model->status;
        $this->description = $this->model->description;
        $this->service_id = $this->model->service_id;

        // relations
        $this->members = $this->model->members;
        $this->managers = $this->model->managers;
        $this->customers = $this->model->customers;
        $this->attachments = $this->model->attachments;
        $this->logs = $this->model->logs;

        // populate form by additional project info
        foreach ($this->model->meta as $meta) {
            if (property_exists($this, $meta->key))
                $this->{$meta->key} = $meta->value;
        }
    }

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

            // update time
            $this->model->setMeta('update_time', time());

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
                foreach ($this->customers as $customer) {
                    if (!isset($customer['id']) || !isset($customer['delete']))
                        continue;

                    $customerModel = CustomerModel::model()->findByPk($customer['id']);
                    if (null === $customerModel)
                        continue;

                    if ($customer['delete']) {
                        $projectUserModel = ProjectUserModel::model()->findByAttributes(array(
                            'project_id' => $this->id,
                            'user_id' => $customerModel->id,
                        ));

                        if (null === $projectUserModel)
                            continue;

                        $projectUserModel->delete();
                    } else
                        $this->model->setUser($customerModel->id);
                }
            }

            // save members
            if ($this->members && !$user->isCustomer) {
                foreach ($this->members as $member) {
                    if (!isset($member['id']) || !isset($member['delete']))
                        continue;

                    $memberModel = MemberModel::model()->findByPk($member['id']);
                    if (null === $memberModel)
                        continue;

                    if ($member['delete']) {
                        $projectUserModel = ProjectUserModel::model()->findByAttributes(array(
                            'project_id' => $this->id,
                            'user_id' => $memberModel->id,
                        ));

                        if (null === $projectUserModel)
                            continue;

                        $projectUserModel->delete();
                    } else
                        $this->model->setUser($memberModel->id);
                }
            }

            // save managers
            if ($this->managers && !$user->isCustomer) {
                foreach ($this->managers as $manager) {
                    if (!isset($manager['id']) || !isset($manager['delete']))
                        continue;

                    $managerModel = ManagerModel::model()->findByPk($manager['id']);
                    if (null === $managerModel)
                        continue;

                    if ($manager['delete']) {
                        $projectUserModel = ProjectUserModel::model()->findByAttributes(array(
                            'project_id' => $this->id,
                            'user_id' => $managerModel->id,
                        ));

                        if (null === $projectUserModel)
                            continue;

                        $projectUserModel->delete();
                    } else
                        $this->model->setUser($managerModel->id);
                }
            }

            // price
            if (!$user->isMember)
                $this->model->setMeta('price', $this->price);

            // feedback
            if ($this->status == ProjectModel::STATUS_COMPLETE && $this->feedback && $user->isCustomer)
                $this->model->setMeta('feedback', $this->feedback);

            // rating
            if ($this->status == ProjectModel::STATUS_COMPLETE && $this->rating && $user->isCustomer)
                $this->model->setMeta('rating', $this->rating);

            // abort project
            if ($this->reason && $user->isAdministrator) {
                if ($this->status != ProjectModel::STATUS_ABORT) {
                    $this->model->status = ProjectModel::STATUS_ABORT;
                    $this->model->save(array('status'));
                }

                $this->model->setMeta('reason', $this->reason);
            }

            // upload
            if (!$user->isCustomer)
                $this->upload();

            return true;
        } else
            return false;
    }
}