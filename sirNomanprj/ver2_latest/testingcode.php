var extra = 0; // testing

<?php $primary_artist_count = 0; ?>

$(".primary_artist").each(function (i) {

  <?php
  $track_primary_artist = "";

  $key = "track_primary_artist[{$primary_artist_count}][]";
  // $primary_artist_count++;
  if (isset($draft_data[$key]) && !empty($draft_data[$key])) {

    if (is_array($draft_data[$key])) {
      // If the value is already an array, encode it to JSON
      $track_primary_artist = json_encode($draft_data[$key]) . ";";
    } else {
      // If the value is not an array, enclose it in double quotes
      $track_primary_artist = "\"" . $draft_data[$key] . "\";";
    }


    echo " var selectedArtists = $track_primary_artist";

  } else {
    echo " var selectedArtists = ''; ";
  }

  ?>
  console.log(selectedArtists)
  console.log(this)
  if (selectedArtists != '') {


    if (Array.isArray(selectedArtists)) {

    

      if (selectedArtists.length) {
      
        console.log(extra)
        extra++;
        for (let index = 0; index < selectedArtists.length; index++) {
          var option = new Option(selectedArtists[index], selectedArtists[index], true, true);
          $(this).append(option);
        }

        <?php


        echo " console.log('primary artist count' + $primary_artist_count);";
        $primary_artist_count++;
        ?>

        $(this).trigger('change');


      } else {
        console.error("Element with id 'track_primary_artist" + i + "' not found.");
      }

      // selectedArtists.forEach(function (value) {
      //   var option = new Option(value, value, true, true);
      //   $(this).append(option);

      // });

      // $(this).trigger('change');
      //  new Option(selectedArtists, selectedArtists, true, true);


      // Trigger the change event to notify Select2 about the changes



    }
    else {
      console.log('#track_primary_artist' + i)
      // console.log(selectedArtists)
      // Assuming you've already initialized Select2 for your select element
      // If not, you need to initialize it first

      // Append options to the select element
      var option = new Option(selectedArtists, selectedArtists, true, true);
      $(this).append(option);

      // Trigger the change event to notify Select2 about the changes
      $(this).trigger('change');


    }


    // Loop through options to mark selected


    // Initialize Select2 after setting selected options
    // $('#track_primary_artist' + i).select2();

  }

  $(this).select2();
});