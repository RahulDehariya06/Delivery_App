<?php
use Illuminate\Http\Request;
    //Single file upload function
	function file_upload(Request $request){
            //Get file
            $file = $request->file('file');
            
            if($file){
            $rdm = uniqid();
            $path = storage_path()."/app/file";
            $name= '/app/file/'.$rdm .'-'.$file->getClientOriginalName();
            $res=$file->move($path, $name);
            if($res){
                return $name;
	         }
	       }
	        
 	 }


     /*
        Multiple file upload function
     */
    function multifileUploder(Request $request){

         if($request->hasFile('store')) {
            //Take file extention
            $allowedfileExtension=['jpg','png','jpeg','webp'];
            $files = $request->file('store'); 
            $errors = [];
            foreach ($files as $file) {      

                $extension = $file->getClientOriginalExtension();
                //Check file extention is valid or not
                $check = in_array($extension,$allowedfileExtension);

                if($check) {
                 foreach($request->store as $mediaFiles) {  
                        $media_ext = $mediaFiles->getClientOriginalName();
                        $media_no_ext = pathinfo($media_ext, PATHINFO_FILENAME);
                        $path = storage_path()."/app/file";
                        $mFiles = '/app/file/'.uniqid() . '.' . $extension;
                        $mediaFiles->move($path ,$mFiles);
                        $filename[]=$mFiles;
                    }
                    return $filename;
                } 
                else {
                 
                    return redirect()->back()->with('error', 'Invalid file format');
                }
                

        }
    }
     return 'no-image';
}


     /*
        Multiple file upload function
     */
    function UploadMultipleFile(Request $request){

      
         if($request->hasFile('file')) {


            //Take file extention
            $allowedfileExtension=['jpg','png','jpeg'];
            $files = $request->file('file'); 
            $errors = [];
             
            foreach ($files as $file) {      

                $extension = $file->getClientOriginalExtension();
                //Check file extention is valid or not
                $check = in_array($extension,$allowedfileExtension);

                if($check) {
                 foreach($request->file as $mediaFiles) { 
                        $media_ext = $mediaFiles->getClientOriginalName();
                        $media_no_ext = pathinfo($media_ext, PATHINFO_FILENAME);
                        $path = storage_path()."/app/file";
                        $mFiles = '/app/file/'.uniqid() . '.' . $extension;
                        $mediaFiles->move($path ,$mFiles);
                        $filename[]=$mFiles;
                    }
                    return $filename;
                } 
                else {
                 
                    return redirect()->back()->with('error', 'Invalid file format');
                }
                

        }
    }
     return 'no-image';
}



function LicenceFront(Request $request){
            //Get file
            $file = $request->file('front_licence');
            
            if($file){
            $rdm = uniqid();
            $path = storage_path()."/app/licence";
            $name= $rdm .'-'.$file->getClientOriginalName();
            $res=$file->move($path, $name);
            if($res){
                return '/app/licence/'.$name;
             }
           }
            
     }
    
  function LicenceBack(Request $request){
            //Get file
            $file = $request->file('back_licence');
            
            if($file){
            $rdm = uniqid();
            $path = storage_path()."/app/licence";
            $name= $rdm .'-'.$file->getClientOriginalName();
            $res=$file->move($path, $name);
            if($res){
                return '/app/licence/'.$name;
             }
           }
            
     }
    


?>