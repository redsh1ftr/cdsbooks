


<?php $getatty = DB::table('qbatty')->get();?>

	@foreach($getatty as $a)

		<?php 
			$atname = DB::table('qbatty')->where('id', '=', $a->id)->pluck('name');
			$newname = Str::limit($atname, $limit = 6, $end = '');?>

			<?php 

			$dbupdate = QBATTY::where('id', '=', $a->id)->first();

				$dbupdate->name = $newname;

				$dbupdate->save();

			?>

			{{$newname}}<br>
	@endforeach		

