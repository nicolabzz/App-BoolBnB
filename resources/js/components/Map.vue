<template>
    <div id="map" ref="mapRef" class="b-round b-shadow"></div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';

export default {
    name: "Map",
    props: {
        address: {
            type: String,
            required: true
        },
        longitude: {
            type: String,
            required: true
        },
        latitude: {
            type: String,
            required: true
        }
    },
    mounted() {
        this.getMap();
    },
    methods: {
        getMap() {
            var map = tt.map({
                key: 'LBnYIIJKuwBHbW3xyrFE1uXJSVAINMJW',
                container: 'map',
                zoom: 8,
                center: [this.longitude, this.latitude]
            });
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

            var markerHeight = 50,
                markerRadius = 10,
                linearOffset = 25;
            var popupOffsets = {
                top: [0, 0],
                'top-left': [0, 0],
                'top-right': [0, 0],
                bottom: [0, -markerHeight],
                'bottom-left': [
                    linearOffset,
                    (markerHeight - markerRadius + linearOffset) * -1
                ],
                'bottom-right': [
                    -linearOffset,
                    (markerHeight - markerRadius + linearOffset) * -1
                ],
                left: [markerRadius, (markerHeight - markerRadius) * -1],
                right: [-markerRadius, (markerHeight - markerRadius) * -1]
            };
            var popup = new tt.Popup({ offset: popupOffsets, className: 'my-class' })
                .setLngLat({ lon: this.longitude, lat: this.latitude })
                .setHTML(`<p>${this.address}</p>`)
                .addTo(map);

            var marker = new tt.Marker()
                .setLngLat([this.longitude, this.latitude])
                .addTo(map);
        }
    }
};
</script>

<style>
#map {
    min-height: 100%;
    min-width: 100%;
}

.b-round {
    border-radius: 15px;
}

.b-shadow {
    box-shadow: 0px 0px 50px 1px rgb(201, 200, 200);
}
</style>
