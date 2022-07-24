
/*jshint esversion: 6 */ 


jQuery( document ).ready(function( $ ) {
    
    var sliderOptions = {
        pager: true,
        gallery: true,
        item: 1,
        thumbItem: 10,
        slideMargin: 0,
        speed: 500,
        auto: true,
        mode:'fade',
        keyPress:true,
        loop: true
    };
	  
        // Add listener to dismiss notices
    $( 'body' ).on( 'click', 'button.notice-dismiss', function() {
        console.log( $( this ).parent().remove() );
    });

   // Whenever the user reorders images, update the slideshow with it
   $( function() {
    $( '#sortable' ).sortable({
        update: function( e, u ) {
            renderSlideshow();
            displayWarningMessage();
        }
    });
    $( '#sortable' ).disableSelection();
    });

    // Initialize Slider
    $( '#lightSlider' ).lightSlider( sliderOptions );
     
    $( '#save-btn' ).click( function( e ) {
        var data = {
            images: getSelectedImagesId(),
            nonce: rtsa.nonce,
            action: 'rtsa_update_images'
        };

        $.post( wp.ajax.settings.url, data ).done( function( data ) {
            displaySuccessMessage();
        });
    });

    // Opens wordpress media manager when user  
    //  clicks on 'Add New Image' button
    $( '#upload-btn' ).click( function( e ) {
        e.preventDefault();
        frame = wp.media({
            title: 'Select Image',
            multiple: true
        });
        frame.on( 'open', function() {
            var selection = frame.state().get( 'selection' );
            ids = getSelectedImagesId();

            // This will pre-select images in wp media manager
            // which have been already selected  
            ids.forEach( function( id ) {
                attachment = wp.media.attachment( id );
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : []);
            });
        })
        .open()
        .on( 'select', function( e ) {
            var selectedImages = frame.state().get( 'selection' );

            // This will return the selected image from the Media Uploader, the result is an array
            renderImages( selectedImages );
            displayWarningMessage();
        });
    });

    // This functions renders slideshow in "Slider Live Preview" Section
    function renderSlideshow() {
        $( '#rtsa-slider-container' ).empty();
        $( '#rtsa-slider-container' ).append( '<ul id="lightSlider"></ul>' );
        $( '#sortable > li' ).each( function() {
            $( '#lightSlider' ).append( `<li data-thumb="${ $( this ).attr( 'data-thumbnail' )}"><img class="slider-items" src="${ $( this ).attr( 'data-fullsize' )}" width='100%' style='max-width:600px'/></li>` );
        });
        $( '#lightSlider' ).lightSlider( sliderOptions );
    }

    // This functions renders selected images "Images" Section 
    function renderImages( images ) {
        $( '#sortable' ).empty();

        images.forEach( function( image ) {
            var img = $( '<img />' ).attr( 'src', image.attributes.sizes.thumbnail.url );
            var item = `<li class="ui-state-default" data-id="${image.id}" data-thumbnail='${image.attributes.sizes.thumbnail.url}' data-fullsize='${image.attributes.url}'>${img[0].outerHTML}</li>`;
            $( '#sortable' ).append( item );
        });
        renderSlideshow();
    }

    // Returns an array ids of selected images
    function getSelectedImagesId() {
        var imageIds = [];
        $( '#sortable > li' ).each( function() {
            imageIds.push( $( this ).attr( 'data-id' ) );
        });
        return imageIds;
    }

    function displaySuccessMessage() {
        $( '#success-message' ).remove();
        $( '#warning-message' ).remove();
        $( '.wrap > h1' ).after( `
        <div id="success-message" class="notice notice-success is-dismissible">
            <p>All Prefrences Saved</p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>` );
    }
    function displayWarningMessage() {
        $( '#success-message' ).remove();
        $( '#warning-message' ).remove();
        $( '.wrap > h1' ).after( `
        <div id="warning-message" class="notice notice-warning is-dismissible">
            <p>Save your changes by pressing 'Save' button otherwise changes will be discarded</p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button> 
        </div>` );
    }

});ss