<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Approval;
use App\Models\Document;
use App\Models\Email;
use App\Models\Life;
use App\Models\Phone;
use App\Repositories\Concerns\WithTypes;
use App\Repositories\Concerns\WithSelectOptions;

class LifeRepository extends CrudRepository
{
    use WithSelectOptions;
    use WithTypes;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Life::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }

    public function afterSave($resource, $attributes)
    {
        if (!empty($attributes['addresses'])) {
            $this->syncAddresses($resource, $attributes['addresses']);
        }

        if (!empty($attributes['phones'])) {
            $this->syncPhones($resource, $attributes['phones']);
        }

        if (!empty($attributes['emails'])) {
            $this->syncEmails($resource, $attributes['emails']);
        }

        if (!empty($attributes['documents'])) {
            $this->syncDocuments($resource, $attributes['documents']);
        }

        if (!empty($resource->getAppends()['approval_object'])) {
            $approval = Approval::find($resource->getAppends()['approval_object']);
            $approval->approvalable_id = $resource->id;
            $approval->save();
        }

        return $resource;
    }

    protected function syncAddresses($life, array $addresses)
    {
        $existingIds = $life->addresses()->pluck('id')->toArray();
        $syncedIds = [];

        foreach ($addresses as $data) {
            $address = $life->addresses()->updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                $data
            );

            $syncedIds[] = $address->id;
        }

        $toDelete = array_diff($existingIds, $syncedIds);

        if ($toDelete) {
            Address::whereIn('id', $toDelete)->delete();
        }
    }

    protected function syncPhones($life, array $phones)
    {
        $existingIds = $life->phones()->pluck('id')->toArray();
        $syncedIds = [];

        foreach ($phones as $data) {
            $data['phone_type_id'] = $data['type'];
            unset($data['type']);

            $phone = $life->phones()->updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                $data
            );

            $syncedIds[] = $phone->id;
        }

        $toDelete = array_diff($existingIds, $syncedIds);

        if ($toDelete) {
            Phone::whereIn('id', $toDelete)->delete();
        }
    }


    protected function syncEmails($life, array $emails)
    {
        $existingIds = $life->emails()->pluck('id')->toArray();
        $syncedIds = [];

        foreach ($emails as $data) {
            $email = $life->emails()->updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                $data
            );

            $syncedIds[] = $email->id;
        }

        $toDelete = array_diff($existingIds, $syncedIds);

        if ($toDelete) {
            Email::whereIn('id', $toDelete)->delete();
        }
    }


    protected function syncDocuments($life, array $documents)
    {
        $existingIds = $life->documents()->pluck('id')->toArray();
        $syncedIds = [];

        foreach ($documents as $data) {
            $document = $life->documents()->updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'document_type_id' => $data['document_type_id'],
                    'number' => $data['number'],
                ]
            );

            $syncedIds[] = $document->id;
        }

        $toDelete = array_diff($existingIds, $syncedIds);

        if ($toDelete) {
            Document::whereIn('id', $toDelete)->delete();
        }
    }
}
