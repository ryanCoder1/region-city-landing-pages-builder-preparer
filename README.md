# region-city-landing-pages-builder-preparer

Sets up a State, City list in .txt file that's originally read from a .txt of zip codes. The results can be copy and pasted into the Wordpress Plugin Region-City-Landing-Pages-Builder. 

For a listing to show up on google maps for a given search (e.g. Web Designers in Manchester, NH) after registering the address through google.

Find a website like https://www.freemaptools.com/find-zip-codes-inside-radius.htm

Start a search of a specific city and the radius from it 
This will print out a list of zip codes that can be put in .txt file. 
The .txt file of the zip codes is ran through the browser as a localhost url
http:// localhost:8080 / generatecitystate.php?fileName= (name of .txt file without the .txt on it) 

With a google map api access key, that you need to provide, the zip codes are read from the .txt file and returned as a State, City 
combination in a new .txt file with the same name as the query string in the url but with (write) added to the end. 

Now you are able to copy and paste the list of State, City names and paste them into 
the Wordpress Plugin region-city-landing-pages-builder.


