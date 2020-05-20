$.prototype.popover = (function(popover) {
	return function(config) {
		try {
			return popover.call(this, config)
		} catch (ex) {
			if (ex instanceof TypeError && config === 'destroy') {
				return popover.call(this, 'dispose')
			}
		}
	}
})($.prototype.popover);
