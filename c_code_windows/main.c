#include <stdio.h>
#include <stdlib.h>
#include <windows.h>

int choice, resp;
char user[], pass[], to[], message[], from[], chat[9999], buffer[9999];

void readChat(){

    system("cls");
    FILE *fp;
    fp = fopen("chat.chat" , "r");

    if (fp != NULL)
    {
        while (fgets(chat, 1000, fp) != NULL)
        {
        printf("%s", chat);
        }
    fclose(fp);
    }
    printf("1. Refresh\n");
    printf("2. Message\n");
    printf("3. Exit\n");
    scanf("%d",&choice);
    switch(choice)
    {
    case 1:
        system("cls");
        readChat();
        break;
    case 2:
        system("cls");
        logedIn();
        break;
    case 3:
        abort();
        break;
    }





}



void doFile( char fil[] ){
    FILE *fp;
    fp = fopen(fil , "r");
    //fscanf(fp, "%ld", resp);
    fgets(chat, 9999, (FILE*)fp);
    fclose(fp);
}

/* The loged in user handler */
void logedIn(){

    printf("Welcome %s!\n\nPlease select an action:\n\t1.  Send Message\n\t2.    Read Messages\n\t3.   Delete Account\n\n\nPick an action:", user);
    scanf("%d", &choice);

    switch(choice){

        case 1:
        //Chat
            printf("Enter Recipient: ");
            scanf("%s", &to);
            printf("Enter Message: ");
            scanf("%s", &message);

            sprintf(buffer, "php interface.php doChat %s %s %s", to, user, message );
            system( buffer );
            doFile("response.chat");

             resp = atoi(chat);
               if(resp == 1){
                    printf("Message sent!");
                    Sleep(2000);
                    system("cls");
                    logedIn();
                }else{
                    printf("Failed to send message!");
                    Sleep(2000);
                    logedIn();
                }

        break;

        case 2:
        //read message
            sprintf(buffer,  "php interface.php readChat %s", user );
            system( buffer );
            doFile("chat.chat");
            readChat();

        break;

        case 3:
        //delete account
            sprintf(buffer,  "php interface.php delUser %s", user );
            system( buffer );
            doFile("response.chat");
             resp = atoi(chat);
               if(resp == 1){
                    printf("User Deleted!");
                    abort();
                }else{
                    printf("Failed to delete user!");
                    Sleep(3000);
                    system("cls");
                    logedIn();
                }

        break;

        default:
            system("clear");
            logedIn();
        break;

    }

}


void userVal(){

    system("cls");
    printf("Username: ");
    scanf("%s", &user);
    printf("\nPassword: ");
    scanf("%s", &pass);

}

void addUser()
{
    userVal();
    sprintf(buffer, "php interface.php addUser %s %s", user, pass);
    system( buffer );
    doFile("response.chat");
        resp = atoi(chat);
       if(resp == 1){
            printf("User added!");
            Sleep(2000);
            system("cls");
            main();
        }else{
            printf("Failed to add user!");
            Sleep(2000);
            system("cls");
            main();
        }


}
void doLogin()
{
    userVal();
    sprintf(buffer, "php interface.php doLogin %s %s", user, pass);
    system( buffer );
    doFile("response.chat");
     resp = atoi(chat);
       if(resp == 1){
            system("cls");
            printf("Login Successful!");
            Sleep(3000);
            system("cls");
            logedIn();
        }else{
            system("cls");
            printf("Failed to Login!");
            Sleep(3000);
            system("cls");
            doLogin();
        }
    printf("Login Successful!");
    printf("%s",chat);
}
int main()
{
    printf("1.      Signup\n2.      Login\n3.       Exit\n:");
    scanf( "%d", &choice );

    switch( choice ){

    case 1:
        addUser();
        //printf("\n\n User: %s \t\tPass: %s", user, pass);
    break;

    case 2:
        doLogin();
    break;



    }

    return 0;
}
