# ICT High School Graduation Project
A website selling lots of earphone also with some special functions
Preparation of multimedia (logo, banner, animation/video)

Implementation of Home page and Product page
General
The overview of the home page

HTML (Header) <blockquote class="imgur-embed-pub" lang="en" data-id="S2UFMb1" data-context="false" ><a href="//imgur.com/S2UFMb1"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>

The following is included in the page inside the <head> element.
The external stylesheet ```index_ai.css```, ```all.min.css```, ```product.css``` is linked in all pages with ```<link>``` element.
The title for each page is included using the <title> element and the icon for the website is included using the ```<link>``` element. It will show as below:
 
Top of the navigation bar:

This allows the logo below to show by using ```<img src=”xxx.png”>``` pattern.
The ```<h1>``` and ```<p>``` are showing the store name and the welcoming sentence.
CSS: 
display: inline-block; does not add a line-break after the element, so the element can sit next to other elements.
It allows you to set width and height on the element, in the code it is set as ```height:72px;``` and ```width: auto;```.


Effect:

HTML of Navigation Bar:
There are buttons for the Home page, products page, a dropdown list for browsing all the brands, a search bar, cart and user icon.
All the buttons are grouped by a CSS called search-container, it plays a part in aligning all the elements in a line.





Effect:

The dropdown menu of Browse by Brand button

CSS:
The buttons in navigation bar will change their text and background colour when the user hovers the curser shown as above.
The origianal text and background colour are white and dark grey respectively, the text and background colour changed to black and light pink after hovering.


Slideshow (by external JavaScript file; ```.js```)
The variable slideIndex is to change the index of the slideshow (picture)

The ```startSlideShow()``` function is for calling the for loop to encounter the operation of slideshow. It changes the slideshow 5 seconds per slide, user can move the slideshow on their own too by the function ```plusSlides()```.
HTML:
```<script> </script>``` is to link to the javascript at the right side.

HTML of product cards located at the latest product session:
The css .row is to group the product cards below in order to stay in a horizontal alignment, and the .block is to set the width of each product card.


The product card will shift up a bit and add a shadow effect when user hovers on it.
It is done by the css below.


Products Page
Products filter:
This is the code of the products filtering side bar.

Effect: 







Products Sorting:
HTML:                                         CSS:

Effect:







Individual product page
The html of the product card ; When pressed, it would redirect to the individual product page

Overall effect:

This function is not finished:

Javascript of quantity button of the product: 

