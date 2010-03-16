<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2010 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class EXIF_GPS_Controller extends Controller {
  public function map($album_id) {
    // Map all items in the specified album.

    // Generate an array of all items in the current album that have exif gps 
    //   coordinates and order by latitude (to group items w/ the same
    //   coordinates together).
    $items = ORM::factory("item")
             ->join("exif_coordinates", "items.id", "exif_coordinates.item_id")
             ->where("items.parent_id", "=", $album_id)
             ->viewable()
             ->order_by("exif_coordinates.latitude", "ASC")
             ->find_all();

    // Make a new page.
    $template = new Theme_View("page.html", "other", "TagsMap");
    $template->page_title = t("Gallery :: Map");
    $template->content = new View("exif_gps_map.html");
			 
    // Load in module preferences.
    $template->content->items = $items;
    $template->content->google_map_key = module::get_var("exif_gps", "googlemap_api_key");

    // Display the page.
    print $template;
  }
}