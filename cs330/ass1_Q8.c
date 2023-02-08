
// The program will create a child process and sleep the parent for 10 seconds allowing the child process to end and be a zombie for 10 seconds 
// Child becomes Zombie as parent is sleeping
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
int main()
{
    // Fork returns process id
    // in parent process
    pid_t child_pid = fork();
  
    // Parent process 
    if (child_pid > 0)
        sleep(10);
  
    // Child process
    else        
        exit(0);
  
    return 0;
}