<?php

namespace App;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    private function successResponse(mixed $data = null) : JsonResponse {
        return response()->json([
            'status' => true,
            'message' => 'Pesan sukses',
            'data' => $data
        ], 200);
    }

    private function errorResponse(mixed $errors) : JsonResponse {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal',
            'errors' => $errors
        ], 400);
    }

    private function notFoundResponse() : JsonResponse {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    private function unauthorizedResponse() : JsonResponse {
        return response()->json([
            'status' => false,
            'message' => 'Anda tidak memiliki akses untuk mengubah data ini'
        ], 401);
    }
}
