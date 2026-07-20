<?php

namespace App\Services;

use App\Models\Users;

class UsersService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Users::all();
    }

    public function count(): int
    {
        return Users::count();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Users::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Users
    {
        return Users::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Users::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Users::findOrFail($id);
        return $record->delete();
    }

    // ── Register (user + optional farmer profile, atomic) ───────────────────────
    /**
     * @param array $validated  the array returned by $request->validated()
     */
    public function registerWithFarmProfile(array $validated, Farmer_ProfilesService $farmerProfilesService): Users
    {
        return Users::transaction(function () use ($validated, $farmerProfilesService) {
            $user = $this->create([
                'role'          => $validated['role'],
                'first_name'    => $validated['first_name'],
                'last_name'     => $validated['last_name'],
                'email'         => $validated['email'],
                'phone_number'  => $validated['phone_number'] ?? null,
                'password_hash' => password_hash($validated['password'], PASSWORD_BCRYPT),
                'profile_photo' => null, // TODO: handle file upload separately
                'status'        => 'active',
            ]);

            if ($validated['role'] === 'farmer') {
                $farmerProfilesService->create([
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