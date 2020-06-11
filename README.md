<p align="center"><img src="https://s3.hallnet.co.uk/interview/task/hn-bit-logo.png"></p>


# URL Shortened

##Steps to reproduce the application

- after cloning the repo, the .env file needs to be changed with the appropriate
details for MySQL database which is used in the app
- the database needs to be migrated
- run npm install && npm run dev
- after the server is started, the database needs to be populated with words that
are used to shorten URLs
- the command is php artisan fill-url
- the command will pull the allowed words and fill the database 

##Approach for choosing a command to pull the list of words

I wanted to make use of two good practices namely:
Command and Service that will encapsulate some of the logic from the controller.
In this particular example the controller can manage if the logic is within it but
for the sake of good practice, I decided to separate them.
Another reason is that the command will run only once when the user initially populates the database. After that, it will be easier to handle collisions when generating the shortened form of the URLs and keep track of the visited links count. This way the app follows more clearly the MVC pattern. The alternative for the chosen approach could be caching and/or file-based database as well as other solutions.

##Notes

- Command(php artisan fill-url) - the command is intended to run at the beginning
  of the application in order to fill the database with the pulled words.
  If the user rerun the command there will be a warning stating
  that the records will be overwritten. 
  
- Pagination - the application will show the last ten URLs that are not private
  and give the user the option to see older records as well.


##Assumptions:
I noticed differences between the description of the assignment and the mock-up.

For example: In the description, it is not mentioned the use of checkbox and custom field for user input of short word, so I made the following assumptions:

- Private checkbox - if the private checkbox is checked the URL will be stored as usual in the database but will not be shown on the page with the list of non-private URLs.

- A field for custom word - if the user fills that field the value needs to be from the list of allowed words (additional checks may apply).


 
