<?php

namespace Database\Seeders;

use App\Models\Texteditor;
use Illuminate\Database\Seeder;

class TexteditorSeeder extends Seeder
{
    public function run(): void
    {
        $texteditor = new Texteditor();
        $texteditor->description = '<figure class="table" style="width:100%;"><table class="ck-table-resized" style="border-color:hsl(0, 0%, 100%);"><colgroup><col style="width:20.14%;"><col style="width:5.01%;"><col style="width:60.92%;"><col style="width:13.93%;"></colgroup><tbody><tr><td>Nomor</td><td colspan="2">: 09/KL/ll/2024</td><td>30 Oktober 2024</td></tr><tr><td>Lampiran</td><td colspan="3">: 1 Bendel</td></tr><tr><td>Perihal</td><td colspan="3">: <strong><u>Daftar Gaji Guru dan Karyawan bulan Oktober 2024&nbsp;</u></strong></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td style="border-color:hsl(0, 0%, 100%);">&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="2"><strong>Yth. Branch Manager</strong></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td style="border-color:hsl(0, 0%, 100%);"><strong>PT. Bank Syariah Indonesia</strong></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td style="border-color:hsl(0, 0%, 100%);"><strong>KC. Purwokerto Karangkobar</strong></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="2">Di Purwokerto</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="2">&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="2">السلام عليكم ورحمة الله وبركاته</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="2">&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td colspan="3">Menindak lanjuti tentang adanya kerjasama dalam hal pengelolaan gaji guru dan karyawan Al Irsyad Al Islamiyyah Purwokerto, maka dengan ini kami sampaikan daftar Gaji bulan Oktober 2024 dengan rincian sbb:</td></tr></tbody></table></figure><p>&nbsp;</p>';
        $texteditor->save();
    }
}
