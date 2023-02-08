#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <sys/types.h>


using namespace std;


int sum =0;
int num;
int numCount;
int max = -100000;
int min = 100000;
int i;
float avg;

void* avg_runner(void *arg)
{

	int *val = (int *) arg;

	for(int i = 0; i < numCount; i++)
	{
		sum += val[i];
		
	}
	avg = sum/numCount;
	pthread_exit(0);
}

void* min_runner(void *arg)
{
	int *val = (int *) arg;

	for(int i = 0; i < numCount; i++)
	{
		if(i == 0)
		{
			min = val[i];
		}
		else if (min > val[i])
			min = val[i];
	}

	pthread_exit(0);
}

void* max_runner(void *arg)
{

	for(int i = 0; i < numCount; i++)
	{
		int *val = (int *) arg;

		if(i ==0)
		{
			max = val[i];
		}
		else if(max < val[i])
			max = val[i];
	}

	pthread_exit(0);
}

int main(int argc, char **argv)
{
  
	printf("This program finds the maximum, minimum, and average of a series of numbers.\n");
	printf("How many numbers would you like to process?\n");
	scanf("%d",&numCount);

	int arg[numCount],i; //array declared to hold numbers

	printf("Enter the numbers\n");

	for(i=0;i<numCount;i++)
    { //reading array values in main itself
	    scanf("%d",&arg[i]);
	}

	pthread_attr_t attr;
	pthread_attr_init(&attr);//creating threads
	pthread_t thread1;
	pthread_t thread2;
	pthread_t thread3;

	pthread_create(&thread1, &attr, avg_runner, arg); //threads callling
	pthread_create(&thread2, &attr, min_runner, arg);
	pthread_create(&thread3, &attr, max_runner, arg);

	pthread_join(thread1, NULL);
	pthread_join(thread2, NULL);
	pthread_join(thread3, NULL);



	printf("The average value is: %f\n", avg);
	printf("The minimum value is: %d\n", min);
	printf("The maximum value is: %d\n", max);

	return 0;
} 