


<?php $getatty = DB::table('qbatty')->where('id', '>', 276)->where('id', '<', 2790)->get();?>

	@foreach($getatty as $a)

		<?php 
			$atname = DB::table('qbatty')->where('id', '=', $a->id)->pluck('name');
			$newname = substr($atname, 1);?>

			<?php 

			$dbupdate = QBATTY::where('id', '=', $a->id)->first();

				$dbupdate->name = $newname;

				$dbupdate->save();

			?>

			{{$newname}}<br>
	@endforeach		

