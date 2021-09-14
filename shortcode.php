function tribe_recurrence_schedule_meta(){
	global $post;
	$details = "";
	$format   = 'F j, Y';
	$format2 = 'g:i a';
		if( tribe_is_recurring_event($post) ) {  
			$recurrence = get_post_meta( $post->ID, '_EventRecurrence', true );
			$details .= '<ul class="calendar-list">';
			foreach($recurrence['rules'] as $eachevent){
				if($eachevent['custom']['type'] == 'Date'){
					$details .= '<li>'.date( $format, strtotime( $eachevent['custom']['date']['date'] ) ).' @ '.$eachevent['custom']['start-time'].'-'.$eachevent['custom']['end-time'].'</li>';
				}else{
					$details .= '<li>'.$eachevent['custom']['type'].' @ '.date( $format2, strtotime($eachevent['EventStartDate'])).'-'.date( $format2, strtotime($eachevent['EventEndDate'])).' until '.date( $format, strtotime( $eachevent['end'] ) ).'</li>';
				}
				
			}
			$details .= '</ul>';
		}
	return $details;
}
add_shortcode('recurrence_schedule', 'tribe_recurrence_schedule_meta');
