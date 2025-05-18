- [x] create sign in page ( translator, user)
- [x] sign in with google
- [x] create home page
- [x] complete the ap
- [x]  make the tables for user, translator
- [x]  add sign up page and method 
- [x]  prevent non admin from sign in to the ap
- [x]  create the key pages that shows the keys with the translations that uses this key

- [x] create a method that give key_id or insert it for inserting in project
- [x] create the method that get json and insert to database
- [x] create the method that get data from db and create json

- [x] works on creating new project
- [x] works on acc new Translators

- [ ] ~~works on image verification methodology~~
- [x] works on verification page

- [x] works on acc verification page (user select the verification that need (multi verification)) or by add third verifier that checks the conflict

- [x] works on adding points and selecting points from user
- [x] works on getting money from points (translators)

- [x] works on dashboard ap and user dashboard

- [ ] ~~fix user (dont show the translators)~~
- [ ] ~~~~fix in user show of password~~
- [ ] ~~fix in the translator the shows of user data~~
- [ ] replace id but select in ap
- [x] change the icon of the pages
- [x] add google sign in
- [x] show error in sign in and signup make them filament page and use livewire

- [x] improve the fill missing data design and add btn that ask are you Translator ? yes no
- [x] create site header and footer
- [x] see how to hide filament pages from the ap

- [ ] ~~create level helper this fn give the next level value it do a it get max points to this level and get the next level and the percent of the current level~~
- [ ] ~~update the image verification add new table related keys~~
- [x] check durationg component 
- [x] add transaction table
- [x] add send points page

- [ ] ~~in projects make the translator views his projects or enrolled projects in a tabs or ?~~
- [x] add login and logout to nav

- [x] in translation verification make sure to -- the active translations 
- [x] in translation verification make sure to -- when the user dont make any action in 5 minutes !!
- [x] multi verification at same time
- [x] enable editing in verification
- [ ] ~~show multi lang in verirication page~~
- [x] works on getting points from the user take points for each words so we need to edit the query if project is normal so we need to check if the user have points for each one
- [ ] 
Publisher  , Translator
publisher -> project manager



# This Page is TODO AND SOME DESC BEFORE ADDING THEM TO THE README

## nav
 [x] add login/ logout 

## project list
[ ] ~~add search~~

## Dashboard
 ### Admin Dashboard
    [x] add todos
    [x] prevent access to admin paned from non admin (create ensure is admin or something)
    [x] add accept translator 
    [x] add accept language update
    [ ] 
 ### project_manager dashboard
    [x] works on design 
    [x] improve pagination design
 ### translator dashboard
    [x] works on design 
    [x] improve pagination design

## User
 [x] add default lang

## Translator
 [ ] ~~work on level next level methodlogy like achivement box ~~ 


## Main Pages
    [-] build home page like longchain 
    [ ]~~ build terms and conditions~~
    [ ] ~~build about us page~~
    [x] build profile page
    [x] build projects page (translator can enroll)

## Main fixes
    [x] fix footer always in bottom
    [x] fix footer content
    [x] why there is lag (error in pagination)
    [x] make the % according on the skipped and un fineshid


## Main add
    [ ] ~~allow translator to add projects~~
    [x] add transaction table for points
    [x] logo and design
    


## Verification Page
    [x] add points to verifier
    [ ] ~~add level to verifier~~
    [ ] ~~shows more than one lang ~~
    [x] update the query remove projects where the user dont have enogh points
    [x] case study (multi project with small amount of money what happens?)
    [x] make when click in a project that enrolled to get trans of this project
    [x] improve page speed and fix bug(in pageination)
    [x] prevent the user from verify the same translation more than one time
    [x] fix error 
    [x] when have only one verifier so in verification is_selected = 1
    [x] if all the verification have the same data the translation done



## Add Project
    [x] improve the design 
    [x] if lang not found add it
    [x] add edit to project
    [x] add new keys 
    [x] add btn to stop project add it in db and update query
    [ ] ~~make the admin able to disable a project and user cant un disable it~~
    [x] make the user able to extract project
    [x] add toast success or faild in add update..

## profile page
    [x] when translator update his translations we need to verify them 
    or add request add lang


## fill missing data page
    [x] move from filament to livewire
    [ ] 

## Verified translation page 
    [x] Create the page
    [ ] ~~works on its logic should have api to get trans in user default lang~~
    [x] make the user select the verification (when selected it update the trans table and sit it with skipped)
    [ ] add filter for not selected 
    [ ] make this page for projects that have more than 1 verification / word
    [ ] in verification if all trans give the same value dont show it and select any one 
    and make it done

## billing page
    [x] do resarsh how to integrate payment method in the app
    [x] purchase points and withdraw points



## this week
  [x] points 
  [x] remove reserved points and replace it by calc
  [ ] ~~fix verification need refresh so need to recheck the points or something~~
 [ ] ~~level~~
 [ ] ~~image verification~~
 [x] check the error in the points (the admin have points more thant it  should)
 [x] check the error in the percentage
 [x] remove fake data
 [x] make the admin panel accessed only by the admin
 [x] fix bug show un enrolled project in verification
 [x] make the user able to export data

## week x
 profile 
 update data
 update pass
 update name
 [ ] ~~if it will not works as needed we will remove the verification for multi project~~

 25/5/1
 [x] add the ali's pages
 [x] make edit project page
 [x] make the user able to extract data
 [x] works on dashboards
 [x] fix this make the dashboard show only the project that have translation to verify

 ## next week 
  [x] make the un accepted translator cant do any thing
  [x] accept translator
  [x] work on the admin dashboard and finish it
  [x] user password  
  [x] change password 
  [x] work on profile and request new lang or remove lang
  [x] work on admin panel add accept add new lang 
  [x] add default lang to the user in signup (in the dashboard or something)
  [ ] ~~show btn in the menu  to choose a lang (not important)~~
  [x] work on users dashboard 
  [x] work on gitting the updated values in user lang
  [ ] ~~check if add project delete the temp unzip or export also~~
  [x] purchase and withdraw using paypal
  [x] make the app support multi lang
  [ ] ~~create laravel package to auto generate keywords?!~~
  [ ] ~~work on config add in the admin panel a page for configaration can be key value table or something like this def lang , point price , ...~~
  

  [x] markdown to html in the view verifictaion
  


## login
 [x] fix un correct password error 

 ## project list
  [x] remove the disabled project from the project list
  [x] hide project that does not have translation for this translator
  [x] hide project if the user is banned








  ## todo for 12/5
  [x] finish the design
  [x] build the points page
  [x] complete the multi lang support
  

  [x] re works
   x profile and trans profile 
   x fill missing data
 [x] prevent user from adding same name project
 [x] add owner name before the name of the project or make the project name uniqe
 [x] in need approve show trans name
 [x] make the percentage on the skipped and done 
 [-] if the user set verifier t 1 then verification auto selected (need tests)
 [x] check approve add lang
 [x] make the menu multi lang ,footer
 [x] hide from btn view verification if project verification no ==1
 [x] see why when edit project it dublicate in the db
 [x] check the percentage error 
 [x] finish all translations (multi lang support)
 [x] add logo

 [x] fix the all same or why there is no veiw verification auto done
 [x] fix the paypal refund 
 [x] remove the un worked part from the translator

 [ ] check the max point is checked in the request
