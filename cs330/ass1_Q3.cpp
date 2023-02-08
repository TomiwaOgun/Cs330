// Name: Tomiwa Ogunleye
// Student Number: 200358407
// Date: 2021-03-25

// Filename: main.cpp
// Purpose: To work with pointers and dynamically allocate
//           an array for the grades of a student as outlined
//           in the exercise description.

#include <string.h>
#include <iostream>
using namespace std;


struct Student
{
  string name;
  int id;
  int* mark;
  ~Student(){delete [] mark; mark = NULL;};
};

void inputStudent(Student* ptr, int numb);   // function prototype for inputting
void printStudent(Student* ptr, int numb);   // function prototype for printing

//*********************** Main Function ************************//
int main ()
{
  Student stu;		  // instantiating an STUDENT object
  Student*  stuPtr = &stu;  // defining a pointer for the object
  int numb_marks;

  cout << "Please enter number of marks: ";
  cin >> numb_marks;

  inputStudent(&stu, numb_marks);	  // inputting from the keyboard into the instance
  printStudent(&stu, numb_marks); // printing the object



  return 0;
} // end main

//-----------------Start of functions----------------------------// 

void inputStudent(Student* ptr, int numb)
{
  cout << "Please enter a name: ";
  cin >> ptr -> name;
  cout << "Please enter an id: ";
  cin >> ptr -> id;
  ptr -> mark = new int[numb];
  for (int i = 0; i < numb; i++)
  {
    cout << "Please enter a mark: ";
    cin >> ptr -> mark[i];
  }

}

void printStudent(Student* ptr, int numb)
{
  cout<< "Student info:" << endl;
  cout <<"Name: " << ptr -> name << endl; 
  cout <<"id: " << ptr -> id << endl; 
    for (int i = 0; i < numb; i++)
  {
    cout << "Mark: "<< ptr -> mark[i] << endl; 
  }
}