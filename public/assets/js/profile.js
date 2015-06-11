"use strict";
(function() {

    var crop, img_width, geocoding_map;
    /* ROTAR */
    $("#picture figcaption i").on("click", function() {
        var angle = 0;
        if ($(this).hasClass('fa-rotate-right')) {
            angle = -90;
        } else {
            angle = 90;
        }

        $.post('/panel/picture/rotate', {
            angle: angle
        }, function(data, textStatus, xhr) {
            $("#picture img").prop('src', data.picture + '?nocahe=' + Math.random());
            $("#user-header img").prop('src', data.picture + '?nocahe=' + Math.random());
        }, 'json');
    });
    /* AVATAR CAMBIAR */
    $("#picture, #picture figcaption, #picture p").dropzone({
        url: "/panel/picture/",
        createImageThumbnails: false,
        init: function() {
            this.on("success", function(file) {
                $(".font-animation").css('display', 'none');


                $.get('/panel/picture', function(data) {
                    $("#image-body").html('<img src="" id="image_crop2" style="max-width: 100%"/>');

                    $("#image_crop2").prop('src', data.picture + '?nocahe=' + Math.random());
                    $("#modal-view").modal();

                    $('#modal-view').on('shown.bs.modal', function(e) {
                        img_width = $('#modal-view img').parent().parent().parent().width();
                        $('#modal-view img').width(img_width);
                        $('#modal-view img').height('auto');

                        crop = $('#image_crop2').Jcrop({
                            bgOpacity: 0.8,
                            bgColor: 'transparent',
                            addClass: 'jcrop-dark',
                            aspectRatio: 1 / 1,
                            onSelect: updateCoords
                        }, function() {
                            var crop_2 = this;
                            crop_2.setSelect([img_width / 3, 65, img_width / 1.5, 65 + 285]);
                            crop_2.setOptions({
                                bgFade: true
                            });
                            crop_2.ui.selection.addClass('jcrop-selection');
                        });
                    })

                }, 'json');

            });

            this.on("addedfile", function(file) {
                $(".font-animation").css('display', 'inline-block');
            });
        }
    });
    /* CAMBIAR COORDENADAS  */
    function updateCoords(c) {
        jQuery('#x').val(c.x);
        jQuery('#y').val(c.y);
        jQuery('#w').val(c.w);
        jQuery('#h').val(c.h);
    };

    /* GEO */
    var eid = 1;
    var mid = 1;

    var $estados = $("#estados");
    var $municipios = $("#municipios");

    $.post('/geo/estados', function(data, textStatus, xhr) {
        $.each(data, function(index, val) {
            if (val.id == eid) {
                var option = '<option value="' + val.id + '" selected>' + val.estado + '</option>';
            } else {
                var option = '<option value="' + val.id + '">' + val.estado + '</option>';
            }

            $estados.append(option);
        });
        $estados.selectpicker('refresh');
        loadMunicipios(eid, mid);
    }, 'json');

    $estados.on("change", function() {
        var id = $(this).val();
        loadMunicipios(id, mid);
    });

    function resetMunicipios() {
        $municipios.empty();
        var option = '<option> -- MUNICIPIO --</option>';
        $municipios.append(option);
    }

    function loadMunicipios(id, mid) {
        var m = mid || '';
        resetMunicipios();

        $.post('/geo/estado/' + id, function(data, textStatus, xhr) {
            $.each(data, function(index, val) {
                if (val.id == m) {
                    var option = '<option value="' + val.id + '" selected>' + val.municipio + '</option>';
                } else {
                    var option = '<option value="' + val.id + '">' + val.municipio + '</option>';
                }
                $municipios.append(option);
            });
            $municipios.selectpicker('refresh');
            $(".save-picture").removeProp('disabled')
        }, 'json');

    }

    geocoding_map = new GMaps({
        el: '#map',
        lat: $("#lat").val(),
        lng: $("#lng").val(),
        zoom: 14,
        click: function(e) {
            geocoding_map.removeMarkers();
            geocoding_map.addMarker({
              lat: e.latLng.k,
              lng: e.latLng.B
          });
            $("#lat").val(e.latLng.k);
            $("#lng").val(e.latLng.B);
            //add ajax
        },                 
    });

    $("#map").css({
        width: '100%',
        height: '400px'
    });

    /* SAVE CROP */

    $("#save-crop").on("click", function() {
        var options = {
            x: $("#x").val(),
            y: $("#y").val(),
            w: $("#w").val(),
            h: $("#h").val(),
            i: img_width
        }
        $.post('/panel/picture/crop', options, function(data, textStatus, xhr) {
            console.log(data);
            $("#picture img").prop('src', data.picture + '?nocahe=' + Math.random());
            $("#user-header img").prop('src', data.picture + '?nocahe=' + Math.random());
            crop.destroy();
        }, 'json');
    })

    /*
        COVER
    */

    $("#cover, #cover figcaption, #cover p").dropzone({
        url: "/panel/cover/",
        createImageThumbnails: false,
        init: function() {
            this.on("success", function(file) {
                $(".font-animation").css('display', 'none');


                $.get('/panel/cover', function(data) {
                    $("#image-body").html('<img src="" id="image_crop2" style="max-width: 100%"/>');

                    $("#image_crop2").prop('src', data.cover + '?nocahe=' + Math.random());
                    $("#modal-view").modal();

                    $('#modal-view').on('shown.bs.modal', function(e) {
                        img_width = $('#modal-view img').parent().parent().parent().width();
                        $('#modal-view img').width(img_width);
                        $('#modal-view img').height('auto');

                        crop = $('#image_crop2').Jcrop({
                            bgOpacity: 0.8,
                            bgColor: 'transparent',
                            addClass: 'jcrop-dark',
                            aspectRatio: 4.50 / 1,
                            onSelect: updateCoords
                        }, function() {
                            var crop_2 = this;
                            crop_2.setSelect([img_width / 3, 65, img_width / 1.5, 65 + 285]);
                            crop_2.setOptions({
                                bgFade: true
                            });
                            crop_2.ui.selection.addClass('jcrop-selection');
                        });
                    })

                }, 'json');

            });

            this.on("addedfile", function(file) {
                $(".font-animation").css('display', 'inline-block');
            });
        }
    });



})();