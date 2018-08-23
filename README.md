# Audiogene Collection

The backend section of [Audiogene App](https://github.com/cnwakama/Audiogene_App) that rans on the server produce a site at [http://audiogene-dev.eng.uiowa.edu:8080/](http://audiogene-dev.eng.uiowa.edu:8080/). The site is produced from [Cakephp Framework 2.10.10](https://book.cakephp.org/2.0/en/contents.html). 

### Controller 
The app sends data to an URL where the Controller is called to distact JSON and image data to an array structure that follows the database structure. The data is saved after the distacting process. Currently data is send to the ***/app/Controller/PatientsController*** but the URL, which is used in the app [http://audiogene-dev.eng.uiowa.edu:8080/index.php/patients/insert](http://audiogene-dev.eng.uiowa.edu:8080/index.php/patients/insert).  

### Model
Variables are set to represent the structure of the database the framework points to when it is Configured. This produces a schema below:

(
Array
           (
               [Patient] => Array
                   (
                       [Gender] => Male
                       [Ethnicity] => White
                       [PatientID] => 1
                       [Audiogram] => Array
                           (
                               [0] => Array
                                   (
                                       [AudiogramID] => 1
                                       [Age] => 0
                                       [AudioPic] => /path
                                   )

                           )

                       [Gender_information] => Array
                           (
                               [0] => Array
                                   (
                                       [FamilyID] => 1
                                       [Inheritance_Pattern] => Dominant
                                       [Genetic_Diagnosis] => DFNA1
                                   )

                           )

                       [Family_member] => Array
                           (
                               [0] => Array
                                   (
                                       [MemberID] => 1
                                       [Relationship] => Father
                                   )

                           )

                   )

           )
)
