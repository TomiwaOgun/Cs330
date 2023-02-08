// The program will create a simple shell program that will run the program input into the mysh> line in the prompt

#include <stdio.h>
#include <unistd.h>
#define MAX LINE 80 /* The maximum length command */
int main(void)
{
char *args[MAX LINE/2 + 1]; /* command line arguments */
int should_run = 1; /* flag to determine when to exit program */
while (should_run) {
    printf("mysh>");
    fflush(stdout);
/**
* After reading user input, the steps are:
* (1) fork a child process using fork()
* (2) the child process will invoke execvp()
* (3) if command included &, parent will invoke wait()
*/

    scanf ("%[^\n]%*c", input);
    printf("input:%s\n",input);
    // splits the string inputs into tokens
    args[i] = strtok(input," ");
    // enters each token into the array 
    while (args[i] != NULL) {
        i++;
        args[i] = strtok(NULL, " ");
    }
    // to find if the user enters exit 
    if(strcmp(args[0], "exit") == 0)
        exit(0);
    
    // if the last input it &
    if(strcmp(args[i-1], "&") != 0)
    {
        // creates the child process and passes argument
        pid_t pid;
        pid = fork();
        if(pid < 0)
        {
            fprintf(stderr,"FORK Failed\n");
            exit(1);
        }
        else if (pid == 0)
        {
            execvp(args[0],args);
            for(int j=0;j<i;j++)
                args[j] = NULL;
        }
        else
        {
            wait(NULL);
        }
        }
    else
    {
        pid_t pid;
        pid = fork();
        if(pid < 0){
            fprintf(stderr,"FORK Failed\n");
            exit(1);
        }
        else if (pid == 0){
            args[i-1] = NULL;
            execvp(args[0],args);
        }
        else
        {
            printf("\n\n");
        }
    }

  }
  return 0;
}

}
return 0;
}