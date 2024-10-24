<?php

namespace App\Http\Controllers;

use App\Models\EggPrice;
use App\Models\EggTransTemp;
use App\Models\EggTrx;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setPrice()
    {
        $eggPrice = EggPrice::join('users', 'users.id', '=', 'egg_prices.user_id')
            ->where('users.level', '3')
            ->select('users.id as userid', 'big', 'small', 'broken', 'level')
            ->get();

        foreach ($eggPrice as $egg) {
            $trxs = EggTrx::where('costumer_id', $egg->userid)->where('tipetrx', 'egg')->where('trxtipe', 'pembelian')->get();
            foreach ($trxs as $trx) {
                $temps = EggTransTemp::where('trx_id', $trx->idtransaksi)->get();
                foreach ($temps as $temp) {

                    if ($temp->egg_id == '1') {
                        $eggTransTemp = EggTransTemp::find($temp->id);
                        $eggTransTemp->update([
                            'price'     => $egg->big,
                            'total'     => $egg->big*$eggTransTemp->qty,
                        ]);
                    }

                    if ($temp->egg_id == '2') {
                        $eggTransTemp = EggTransTemp::find($temp->id);
                        $eggTransTemp->update([
                            'price'     => $egg->small,
                            'total'     => $egg->small*$eggTransTemp->qty,
                        ]);
                    }

                    if ($temp->egg_id == '3') {
                        $eggTransTemp = EggTransTemp::find($temp->id);
                        $eggTransTemp->update([
                            'price'     => $egg->broken,
                            'total'     => $egg->broken*$eggTransTemp->qty,
                        ]);
                    }
                    

                }
                $sumPrice = EggTransTemp::where('trx_id', $trx->idtransaksi)->sum('total');
                $eggTrx = EggTrx::find($trx->id);
                $eggTrx->update([
                    'totalprice'    => $sumPrice,
                    'disc'          => 0,
                    'keterangan'    => '-',
                ]);
            }
        }
    }
}
