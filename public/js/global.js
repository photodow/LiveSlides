var global = { 
	var: {}
};

// center vertically
global.centVert = function (obj) { // 
    'use strict';
	
	// variabls declared in this scope
    var objHeight, parentHeight, marginTop;
	
    // the object's height
    objHeight = obj.height();
	// the object's parent's height
    parentHeight = obj.parent().height();
	// half of the available space
    marginTop = ((parentHeight - objHeight) / 2);
	
	/* if half of the available space is any less than 85px
	** the header may cut the top of the object off */
    if (marginTop > 85) {
		// set the margin-top to half of the available space
        obj.css('marginTop', marginTop);
    } else {
		// set the margin-top to 85px
        obj.css('marginTop', '85px');
    }
};

global.var.centVert = $('.centVert');

global.centVert(global.var.centVert);

window.onresize = function(){
	global.centVert(global.var.centVert);
};