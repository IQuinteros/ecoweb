HTMLCollection.prototype.foreach = function (callback) {
    for(let i = 0; i < this.length; i++){
        if(callback != undefined) callback(this[i]);
    }
}

let items = document.getElementsByClassName('hover--card');

items.foreach(el => {    

    /*
    * Add a listener for mousemove event
    * Which will trigger function 'handleMove'
    * On mousemove
    */
    el.addEventListener('mousemove', (e) => {
        const height = el.clientHeight
        const width = el.clientWidth

        /*
            * Get position of mouse cursor
            * With respect to the element
            * On mouseover
            */
        /* Store the x position */
        const xVal = e.layerX
        /* Store the y position */
        const yVal = e.layerY
        
        /*
            * Calculate rotation value along the Y-axis
            * Here the multiplier 20 is to
            * Control the rotation
            * You can change the value and see the results
            */
        const yRotation = 10 * ((xVal - width / 2) / width)
        
        /* Calculate the rotation along the X-axis */
        const xRotation = -10 * ((yVal - height / 2) / height)

        console.log(width);
        console.log(height);
        console.log('Y' + yRotation);
        console.log('X' + xRotation);
        
        /* Generate string for CSS transform property */
        const string = 'perspective(500px) scale(1.0) rotateX(' + xRotation.toFixed(2) + 'deg) rotateY(' + yRotation.toFixed(2) + 'deg)'
        
        /* Apply the calculated transformation */
        el.style.transform = string
    })


    /* Add listener for mouseout event, remove the rotation */
    el.addEventListener('mouseout', function() {
        el.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
    })
})

