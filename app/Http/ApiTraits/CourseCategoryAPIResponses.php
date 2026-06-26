<?php

namespace App\Http\ApiTraits;

trait CourseCategoryAPIResponses
{
    use ApiResponse;

    // Successes
    private function courseCategoryIndexSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil mendapatkan list 'courseCategory'", 200, $data);
    }

    private function courseCategoryStoreSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Permintaan menyimpan 'courseCategory' baru berhasil", 202, $data);
    }

    private function courseCategoryShowSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil mendapatkan 'courseCategory' yang dicari", 200, $data);
    }

    private function courseCategoryUpdateSuccessResponse(mixed $data) {
        return $this->generalResponse(true, "Berhasil memperbaharui 'courseCategory' yang dicari", 200, $data);
    }

    private function courseCategoryDestroySuccessResponse() {
        return $this->generalResponse(true, "Permintaan menghapus 'courseCategory' berhasil", 202);
    }

    // Failures
    private function courseCategoryStoreValidationFailedResponse(mixed $error) {
        return $this->generalResponse(false, "Validasi untuk permintaan menyimpan 'courseCategory' gagal", 400, $error);
    }

    private function courseCategoryUpdateValidationFailedResponse(mixed $error) {
        return $this->generalResponse(false, "Validasi untuk permintaan memperbaharui 'courseCategory' gagal", 400, $error);
    }

    private function courseCategoryNotFoundResponse() {
        return $this->generalResponse(false, "'CourseCategory' yang dicari tidak ditemukan", 404);
    }
}
