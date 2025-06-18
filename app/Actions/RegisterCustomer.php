<?php

namespace App\Actions;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisterCustomer
{
    public function handle(array $attributes, ?UploadedFile $logo = null): void
    {
        $logoPath = null;
        if ($logo) {
            $fileName = Str::uuid().'.'.$logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('uploads/logos', $fileName, 'public');
        }

        try {
            DB::transaction(function () use ($attributes, $logoPath) {
                $customer = Customer::create([
                    'first_name' => $attributes['first_name'],
                    'last_name' => $attributes['last_name'],
                    'email' => $attributes['email'],
                    'phone' => $attributes['phone'],
                ]);

                Company::create([
                    'customer_id' => $customer->id,
                    'name' => $attributes['company_name'],
                    'country_code' => $attributes['country_code'],
                    'logo_path' => $logoPath,
                ]);
            });
        } catch (\Throwable $th) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            throw $th;
        }
    }
}
