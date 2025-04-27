- [x] create sign in page ( translator, user)
- [x] sign in with google
- [ ] create home page
- [ ] complete the ap
- [x]  make the tables for user, translator
- [x]  add sign up page and method 
- [ ]  prevent non admin from sign in to the ap
- [x]  create the key pages that shows the keys with the translations that uses this key

- [x] create a method that give key_id or insert it for inserting in project
- [x] create the method that get json and insert to database
- [ ] create the method that get data from db and create json

- [ ] works on creating new project
- [ ] works on acc new Translators

- [ ] works on image verification methodology
- [-] works on verification page

- [ ] works on acc verification page (user select the verification that need (multi verification)) or by add third verifier that checks the conflict

- [ ] works on adding points and selecting points from user
- [ ] works on getting money from points (translators)

- [-] works on dashboard ap and user dashboard

- [ ] ~~fix user (dont show the translators)~~
- [ ] ~~~~fix in user show of password~~
- [ ] ~~fix in the translator the shows of user data~~
- [ ] replace id but select in ap
- [x] change the icon of the pages
- [x] add google sign in
- [ ] show error in sign in and signup make them filament page and use livewire

- [ ] improve the fill missing data design and add btn that ask are you Translator ? yes no
- [x] create site header and footer
- [x] see how to hide filament pages from the ap

- [ ] create level helper this fn give the next level value it do a it get max points to this level and get the next level and the percent of the current level
- [ ] update the image verification add new table related keys
- [x] check durationg component 
- [ ] add transaction table
- [ ] add send points page

- [ ] in projects make the translator views his projects or enrolled projects in a tabs or ?
- [ ] add login and logout to nav

- [ ] in translation verification make sure to -- the active translations 
- [ ] in translation verification make sure to -- when the user dont make any action in 5 minutes !!
- [x] multi verification at same time
- [x] enable editing in verification
- [ ] show multi lang in verirication page
- [ ] works on getting points from the user take points for each words so we need to edit the query if project is normal so we need to check if the user have points for each one
- [ ] 
Publisher  , Translator
publisher -> project manager



# This Page is TODO AND SOME DESC BEFORE ADDING THEM TO THE README

## nav
 [x] add login/ logout 

## project list
[ ] add search

## Dashboard
 ### Admin Dashboard
    [ ] add todos
 ### project_manager dashboard
    [ ] works on design 
    [ ] improve pagination design
 ### translator dashboard
    [ ] works on design 
    [ ] improve pagination design

## User
 [x] add default lang

## Translator
 [ ] work on level next level methodlogy like achivement box  


## Main Pages
    [ ] build home page like longchain 
    [ ] build terms and conditions
    [ ] build about us page
    [ ] build profile page
    [ ] build projects page (translator can enroll)

## Main fixes
    [x] fix footer always in bottom
    [ ] fix footer content
    [x] why there is lag (error in pagination)

## Main add
    [ ] allow translator to add projects
    [ ] add transaction table for points
    


## Verification Page
    [ ] add points to verifier
    [ ] add level to verifier
    [ ] shows more than one lang 
    [ ] update the query remove projects where the user dont have enogh points
    [ ] case study (multi project with small amount of money what happens?)
    [x] make when click in a project that enrolled to get trans of this project
    [x] improve page speed and fix bug(in pageination)
    [x] prevent the user from verify the same translation more than one time
    [x] fix error 
    [ ] when have only one verifier so in verification is_selected = 1


## Add Project
    [ ] improve the design 
    [x] if lang not found add it
    [ ] add edit to project
    [ ] on edit dont re add what is in only if it empty
    [ ] add btn to stop project add it in db and update query
    [ ] make the admin able to disable a project and user cant un disable it


## profile page
    [ ] when translator update his translations we need to verify them 
    or add request add lang


## fill missing data page
    [x] move from filament to livewire
    [ ] 

## Verified translation page 
    [x] Create the page
    [ ] works on its logic should have api to get trans in user default lang
    [x] make the user select the verification (when selected it update the trans table and sit it with skipped)
    [ ] add filter for not selected 
    [ ] make this page for projects that have more than 1 verification / word
    [ ] in verification if all trans give the same value dont show it and select any one 
    and make it done

## billing page
    [ ] purchase points and withdraw points

