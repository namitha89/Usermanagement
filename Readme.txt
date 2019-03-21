#Usermanagement using Symfony 4.2

Demo available at http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/

#Credentails for above demo
Email : admin@example.com
Password : 12345


##Steps to install
1. git clone https://github.com/namitha89/Usermanagement.git
2. cd Usermanangement
3. composer install
4. php bin/console doctrine:database:create
5. php bin/console make:entity
6. php bin/console make:migration
7. php bin/console doctrine:migrations:migrate
8. php bin/console make:fixtures
9. php bin/console doctrine:fixtures:load
11. Go to login page http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/
12. Once Login continue with the flow.

## Techonologies used

### Backend technologies
1. php 7.2
2. Symfony 4.2 for webframework
3. mysql for database

### Frontend
1. HTML + CSS + bootstrap +jquery

### Deployment
1. AWS



### Implementation details

0. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/login
	Login url 
1. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/
	Contains the list of Group
2. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/category/new
	Creates a new form
3. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/category/edit/{id}
	Update the required group
4. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/show/{id}
	Shows the details of the group
5. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/user/index
	Contains the list of users
6. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/user/new
	Create new user
7. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/user/edit/{id}
	Update specific user
8. http://ec2-18-220-103-37.us-east-2.compute.amazonaws.com/user/show/{id}
	Shows specific user details





## Backend functionality

1. Install the symfony 4.2 skeleton.  

2. Create a usersermanagement database and add dasabase name in .env file.

3. Create the necessary table from the entity folder using doctrine migrations.

4. Load the admin data for login from datafixtures.

5. login as admin using data loaded from datafixtures.

6. Once successfull login page will be redirected to group list.

7. Create a group using create form. 

8. Form can be edited.

9. Group details is displayed in show.

10. You can delete the group if user not yet assigned to it.

11. Create user to specific group.

12. Edit user details.

13. Show user details.

14. Delete user Deltails.


