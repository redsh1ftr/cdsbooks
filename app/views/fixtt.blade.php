<?php $get = Case::all();?>


@foreach($get as $gg)

	<?php $claim = DB::table('locases')->where('id', $gg->id)->pluck('claim');

			$directoryname = str_replace('JT # ', '', $replace->claim);
			$directoryname = str_replace('JT# ', '', $directoryname);
			$directoryname = str_replace('JT ', '', $directoryname);
			$directoryname = str_replace('Jt#', '', $directoryname);
			$directoryname = str_replace('JT#', '', $directoryname);
			$directoryname = str_replace('JR#', '', $directoryname);
			$directoryname = str_replace('JR #', '', $directoryname);
			$directoryname = str_replace('JR # ', '', $directoryname);?>

	<?php $update = Case::where('id', $gg->id)->first();

			$update->claim = $directoryname;

			$update->save();?>

{{$directoryname}}

@endforeach
