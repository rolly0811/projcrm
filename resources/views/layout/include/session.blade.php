 <?php
 $manager_session = Session::get('session');

 if($manager_session)
 {
	   $language = $manager_session->manager_language; 
	   if($language == 0)
	   {
			$lang = 'language.en';
	   }
	   else if($language == 1)
	   {
			$lang = 'language.kr';
	   }
 }
 else
 {
	return redirect('/login');
 }
?>