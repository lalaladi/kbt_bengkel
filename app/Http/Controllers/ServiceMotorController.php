<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Service\OrderService;

use App\Service;
use App\Barang;
use App\Mekanik;
use App\ServiceBarang;
use App\NotaService;

class ServiceMotorController extends Controller
{
    public function order()
    {
        return view('service_motor.order');
    }

    public function storeOrder(Request $request)
    {
        //id_member?, id_kupon?, nama_pelanggan, no_telepon_pelanggan, alamat_pelanggan, data[][barang], data[][service][][keterangan], data[][service][harga_satuan], data[][service][jumlah]
        DB::beginTransaction();
        try {
            $nota = OrderService::generateNota($request->except('data'));
            $total_harga = 0;
            foreach ($request->data as $key => $value) {
                $barang = Barang::create([
                    'nama' => $value['barang']
                ]);
                foreach ($value['service'] as $k => $v) {
                    $service = Service::where('id', $v['id_service'])->select('id', 'nama', 'harga_minimal', 'harga_maksimal')->first();
                    if ($service->harga_minimal <= $v['harga_satuan'] && $v['harga_satuan'] <= $service->harga_maksimal) {
                        $total_harga += $v['jumlah'] * $v['harga_satuan'];
                        $data = [
                            'id_nota' => $nota['id'],
                            'id_barang' => $barang->id,
                            'id_service' => $v['id_service'],
                            'keterangan' => $v['keterangan'],
                            'jumlah' => $v['jumlah'],
                            'harga_satuan' => $v['harga_satuan']
                        ];
                        ServiceBarang::create($data);
                    } else {
                        throw new \Exception('Service '.$service->nama.' harganya tidak sesuai range');
                    }
                }
            }
            NotaService::where('id', $nota['id'])->update(['total_harga' => $total_harga - $nota['potongan_harga']]);
            DB::commit();
            return response()->json(['message' => 'Order berhasil dibuat', 'nota_id' => $nota['id']]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function list(Request $request)
    {
        if ($request->q) {
            $service = Service::where('nama', 'like', '%'.$request->q.'%')->get();
        } elseif ($request->id_service) {
            $service = Service::where('id', $request->id_service)->first();
        } else {
            $service = Service::select('id', 'nama', 'harga_minimal', 'harga_maksimal')->get();
        }
        return response()->json(['data' => $service]);
    }
} 