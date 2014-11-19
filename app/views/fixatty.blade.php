
<?php $get = Atty::get();?>

@foreach($get as $gg)

	<?php $claim = DB::table('latty')->where('id', $gg->id)->pluck('pnum');

			$directoryname = str_replace('(CD)', '', $claim);
			$directoryname = str_replace('MM', '', $directoryname);?>

	<?php $update = Atty::where('id', $gg->id)->first();

			$update->pnum = $directoryname;

			$update->save();?>

{{$directoryname}}<br>

@endforeach
