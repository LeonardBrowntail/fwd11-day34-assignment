<?php

namespace App\Http\ApiTraits;

use App\Http\ApiTraits\ApiResponse;

trait CourseAPIResponses
{
    use ApiResponse;

    // Successes
    private function courseIndexSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil mendapatkan list 'courses'", 200, $data);
    }

    private function courseStoreSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Permintaan menyimpan 'course' baru berhasil", 202, $data);
    }

    private function courseShowSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil mendapatkan 'course' yang dicari", 200, $data);
    }

    private function courseUpdateSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil memperbaharui 'course' yang dicari", 200, $data);
    }

    private function courseDestroySuccessResponse() {
        return $this->generalResponse(true, "Permintaan menghapus 'course' berhasil", 202);
    }

    // Failures
    private function courseStoreValidationFailedResponse(mixed $error) {
        return $this->generalResponse(false, "Validasi untuk permintaan menyimpan 'course' gagal", 400, $error);
    }

    private function courseUpdateValidationFailedResponse(mixed $error) {
        return $this->generalResponse(false, "Validasi untuk permintaan memperbaharui 'course' gagal", 400, $error);
    }

    private function courseUpdateNotOwnerResponse() {
        return $this->generalResponse(false, "Anda tidak memiliki hak untuk mengubah 'course' ini", 402);
    }

    private function courseDestroyNotOwnerResponse() {
        return $this->generalResponse(false, "Anda tidak memiliki hak untuk menghapus 'course' ini", 402);
    }

    private function courseNotFoundResponse() {
        return $this->generalResponse(false, "'Course' yang dicari tidak ditemukan", 404);
    }
}
