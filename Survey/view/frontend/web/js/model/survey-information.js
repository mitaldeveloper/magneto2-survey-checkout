define(
    [
        'ko',
        'uiComponent'
    ],
    function (ko, Component) {
        'use strict';

        return Component.extend({            
            surveyOptions: ko.observableArray([])
        });
    }
);
