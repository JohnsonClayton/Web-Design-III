# CSCI 306 : Web Design 3

## Song Voting App for KMSA 91.3FM
  - This allows users view and vote for songs on the KMSA playlist
  - Using LAMP Stack Technology, if integrated into the system at KMSA, the stack would most likely change to accomodate for whatever they have.
  
### Front-End
  - Building HTML pages using PHP
    - Using same ideas presented in class to build "Page" class
  - Pages are built and incorporate AJAX to improve usability from user's point of view
  
  
### Back-End
  - Apache Server is hosting on Ubuntu (since I'm not using production-level equipment)
  - PHP handling requests sent from client-side pages
  - Scripts accessing databases have limited access:
    - If looking for songs to add, the scripts have VIEW permission
    - When adding songs to playlists, scripts have VIEW and WRITE permission
  - Database
    - MySQL Database: KMSA
    - Two Tables: Playlist and Music to hold current playlist and to hold all accessible music, respectively.
    
### Security
  - No users can login into the page
  - All scripts accessing the databases are using non-root users with minimal access rights
  - Information presented is all public and no information is private so security is easier
    - No passwords/PII available for breaches

Coursework for CSCI306 Web Design III with Dr. Warren MacEvoy Jr. 
