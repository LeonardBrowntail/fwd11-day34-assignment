<?php

namespace App;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    private function generalResponse(bool $status, string $message, int $code, mixed $data = null) {
        $json = [
            'status' => $status,
            'message' => $message
        ];
        if ($data) {
            if ($status) {
                $json['data'] = $data;
            } else {
                $json['errors'] = $data;
            }
        }
        return response()->json($json, $code);
    }

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
