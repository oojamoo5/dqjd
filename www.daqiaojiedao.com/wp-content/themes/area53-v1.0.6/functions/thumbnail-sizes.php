<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Thumbnail Sizes
	
	Description: Define thumbnail sizes
	
------------------------------------------------------------------------------------------------------------ */

set_post_thumbnail_size(100, 100, true);
	
/* -----------------------------------------------------------------
	Sizes without specific height and no cropping
----------------------------------------------------------------- */
add_image_size('jw_full', 920, 9999, false); /* full width - no height - no crop */
add_image_size('jw_three_fourth', 683, 9999, false); /* three fourth width - no height - no crop */
add_image_size('jw_two_third', 604, 9999, false); /* two third width - no height - no crop */
add_image_size('jw_one_half', 445, 9999, false); /* one half width - no height - no crop */
add_image_size('jw_one_third', 286, 9999, false); /* one third width - no height - no crop */
add_image_size('jw_one_fourth', 207, 9999, false); /* one fourth width - no height - no crop */

/* -----------------------------------------------------------------
	Sizes with specific height and cropping
----------------------------------------------------------------- */
add_image_size('jw_full_crop', 920, 920, true); /* full width - height - no crop */
add_image_size('jw_three_fourth_crop', 683, 683, true); /* three fourth width - height - crop */
add_image_size('jw_two_third_crop', 604, 604, true); /* two third width - height - crop */
add_image_size('jw_one_half_crop', 445, 445, true); /* one half width - height - crop */
add_image_size('jw_one_third_crop', 286, 286, true); /* one third width - height - crop */
add_image_size('jw_one_fourth_crop', 207, 207, true); /* one fourth width - height - crop */

/* -----------------------------------------------------------------
	Other
----------------------------------------------------------------- */
add_image_size('jw_tiny', 65, 65, true); /* height - crop */