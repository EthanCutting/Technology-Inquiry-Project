//   Created by: Ethan PP Cutting - 3/05/2023
//   modified last: Ethan PP Cutting - 3/05/2023


// Making save link value function so when the user clicks select it will take them to 3 different pages
function saveLinkValue(unitId) 
{   
    // switch statement checking the value of 'unitID' parameter that is bring passed into the 'saveLinkValue()'
    switch (unitId) 
    {  
      // case 'Creation Web Applications': - this case is checking whether the unitId parameter is equal to the string 'Creation Web Applications'
      case 'Creation Web Applications':
        // If so then the function sets the '  window.location.href' to 'preferenceform1.html'
        window.location.href = 'preferenceform1.html';
        // break will stop the execution of code inside this switch
        break;
      // case 'Data Management': - this case is checking whether the unitId parameter is equal to the string 'Data Management'
      case 'Data Management':
        // If so then the function sets the '  window.location.href' to 'preferenceform2.html'
        window.location.href = 'preferenceform2.html';
        // break will stop the execution of code inside this switch
        break;
      // case 'Data Science': - this case is checking whether the unitId parameter is equal to the string 'Data Science'
      case 'Data Science':
        // If so then the function sets the '  window.location.href' to 'preferenceform3.html'
        window.location.href = 'preferenceform3.html';
        // break will stop the execution of code inside this switch
        break;
        // Default is used for fallback option for an example none of the cases match from the given value
        // and if the input value doesnt match any of the cases then the 'default' block will be executed.
      default:
        // break will stop the execution of code inside this switch
        break;
    }
  }
  