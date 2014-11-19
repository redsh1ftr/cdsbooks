<?php $get = DB::table('locases')->get();?>


@foreach($get as $gg)

	<?php $replace = DB::table('locases')->where('id', $gg->id)->pluck('claim');

			$directoryname = str_replace('JT # ', '', $replace);
			$directoryname = str_replace('JT# ', '', $directoryname);
			$directoryname = str_replace('JT ', '', $directoryname);
			$directoryname = str_replace('Jt#', '', $directoryname);
			$directoryname = str_replace('JT#', '', $directoryname);
			$directoryname = str_replace('JR#', '', $directoryname);
			$directoryname = str_replace('JR #', '', $directoryname);
			$directoryname = str_replace('JR # ', '', $directoryname);
			$directoryname = str_replace('HG # ', '', $directoryname);
			$directoryname = str_replace('HG# ', '', $directoryname);
			$directoryname = str_replace('HG#', '', $directoryname);
			$directoryname = str_replace('Hg#', '', $directoryname);
			$directoryname = str_replace('Hg #', '', $directoryname);
			?>

	<?php $update = Case2::where('id', $gg->id)->first();

			$update->claim = $directoryname;

			$update->save();?>

{{$directoryname}}<br>

@endforeach
