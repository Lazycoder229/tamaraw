<?php

namespace App\Services;

use App\Models\Users;

class UsersService
{
    public function __construct(
        private Farmer_ProfilesService $farmerProfilesService // ← nasa constructor na, hindi method param
    ) {}

    public function all(): array
    {
        return Users::all();
    }

    public function count(): int
{
    return Users::select('id')
        ->where('role', 'buyer')
        ->where('status', 'active')  // AND, hindi OR
        ->count(); 
}

public function countFarmers(): int
{
    return Users::select('id')
        ->where('role', 'farmer')
        ->where('status', 'active')  // AND, hindi OR
        ->count(); 
}
    public function find(int|string $id): mixed
    {
        return Users::findOrFail($id);
    }

    public function create(array $data): Users
    {
        return Users::create($data);
    }

    public function update(int|string $id, array $data): bool
    {
        $record = Users::findOrFail($id);
        return $record->update($data);
    }

    public function delete(int|string $id): bool
    {
        $record = Users::findOrFail($id);
        return $record->delete();
    }

    public function registerWithFarmProfile(array $validated): Users // ← isang param na lang
    {
        return Users::transaction(function () use ($validated) {
            $user = $this->create([
                'role'          => $validated['role'],
                'first_name'    => $validated['first_name'],
                'last_name'     => $validated['last_name'],
                'email'         => $validated['email'],
                'phone_number'  => $validated['phone_number'] ?? null,
                'password_hash' => bcrypt($validated['password']),
                'profile_photo' => null,
                'status'        => 'active',
            ]); 

            if ($validated['role'] === 'farmer') {
                $this->farmerProfilesService->create([
                    'user_id'            => $user->id,
                    'farm_name'          => $validated['farm_name'],
                    'farm_description'   => $validated['farm_description'] ?? null,
                    'farm_barangay'      => $validated['farm_barangay'] ?? null,
                    'store_open'         => !empty($validated['store_open']) ? 1 : 0,
                    'delivery_available' => !empty($validated['delivery_available']) ? 1 : 0,
                    'pickup_available'   => !empty($validated['pickup_available']) ? 1 : 0,
                ]);
            }

            return $user;
        });
    }
}