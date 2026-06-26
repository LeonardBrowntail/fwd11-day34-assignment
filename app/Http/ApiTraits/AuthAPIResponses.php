<?php

namespace App\Http\ApiTraits;

trait AuthAPIResponses
{
    use ApiResponse;

    private function registerSuccessResponse() {
        return $this->generalResponse(true, "Berhasil mendaftar", 201);
    }

    private function loginSuccessResponse(string $token) {
        return $this->generalResponse(true, "Berhasil masuk akun", 200, ["token" => $token]);
    }

    private function logoutSuccessResponse() {
        return $this->generalResponse(true, "Berhasil keluar akun", 200);
    }

    private function registerFailedValidationResponse(mixed $errors) {
        return $this->generalResponse(false, "Permintaan mendaftar tidak valid", 402, $errors);
    }

    private function loginFailedValidationResponse(mixed $errors) {
        return $this->generalResponse(false, "Permintaan login tidak valid", 402, $errors);
    }

    private function loginFailedAuthenticationResponse() {
        return $this->generalResponse(false, "Login gagal, email atau password salah", 402);
    }

    private function logoutFailedResponse(string $errors) {
        return $this->generalResponse(false, "Logout gagal", 400, $errors);
    }
}
