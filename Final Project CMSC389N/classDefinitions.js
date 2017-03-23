"use strict";

class User
{
    constructor(dirId, email, password)
    {
        this.dirId = dirId;
        this.email = email;
        this.password = password;   
    }
}

class Item
{
    constructor(name, condition, status)
    {
        this.name = name;
        this.condition = condition;
        this.checkedOut = status;
    }
    
    isCheckedOut()
    {
        return this.checkedOut;
    }
}