https://www.typescriptlang.org/docs/handbook/intro.html

# TypeScript for JavaScript Programmers
## Types by Inference
```
let helloWorld = "Hello World";
//  ^ = let helloWorld: string
```

## Defining Types
```
interface User {
  name: string;
  id: number;
}

const user: User = {
  username: "Hayes",

/*
Type '{ username: string; id: number; }' is not assignable to type 'User'.
  Object literal may only specify known properties, and 'username' does not exist in type 'User'.
*/

  id: 0,
};
```
```
interface User {
  name: string;
  id: number;
}

class UserAccount {
  name: string;
  id: number;

  constructor(name: string, id: number) {
    this.name = name;
    this.id = id;
  }
}

const user: User = new UserAccount("Murphy", 1);
```

## Composing Types
### Unions
```
type MyBool = true | false;
type WindowStates = "open" | "closed" | "minimized";
type LockStates = "locked" | "unlocked";
type OddNumbersUnderTen = 1 | 3 | 5 | 7 | 9;
```
```
function wrapInArray(obj: string | string[]) {
  if (typeof obj === "string") {
    return [obj];
//          ^ = (parameter) obj: string
  } else {
    return obj;
  }
}
```

### Generics
```
type StringArray = Array<string>;
type NumberArray = Array<number>;
type ObjectWithNameArray = Array<{ name: string }>;

interface Backpack<Type> {
  add: (obj: Type) => void;
  get: () => Type;
}

// This line is a shortcut to tell TypeScript there is a
// constant called `backpack`, and to not worry about where it came from.
declare const backpack: Backpack<string>;

// object is a string, because we declared it above as the variable part of Backpack.
const object = backpack.get();

// Since the backpack variable is a string, you can't pass a number to the add function.
backpack.add(23);

//Argument of type 'number' is not assignable to parameter of type 'string'.
```

## Structural Type System
```
interface Point {
  x: number;
  y: number;
}

function logPoint(p: Point) {
  console.log(`${p.x}, ${p.y}`);
}

// logs "12, 26"
const point = { x: 12, y: 26 };
logPoint(point);

const point3 = { x: 12, y: 26, z: 89 };
logPoint(point3); // logs "12, 26"

const rect = { x: 33, y: 3, width: 30, height: 80 };
logPoint(rect); // logs "33, 3"

const color = { hex: "#187ABF" };
logPoint(color);
//Argument of type '{ hex: string; }' is not assignable to parameter of type 'Point'.
//  Type '{ hex: string; }' is missing the following properties from type 'Point': x, y
```

# 1.The Basics
## Static type-checking
## Non-exception Failures
## Types for Tooling
## tsc, the TypeScript compiler
### Emitting with Errors
## Explicit Types
## Erased Types
## Downleveling
## Strictness
### noImplicitAny
### strictNullChecks

# 2.Everyday Types
## The primitives: string, number, and boolean
## Arrays
## any
### noImplicitAny
## Type Annotations on Variables
## Functions
### Parameter Type Annotations
### Return Type Annotations
### Anonymous Functions
## Object Types
### Optional Properties
## Union Types
### Defining a Union Type
### Working with Union Types
## Type Aliases
## Interfaces
### Differences Between Type Aliases and Interfaces
## Type Assertions
## Literal Types
### Literal Inference
## null and undefined
### strictNullChecks off
### strictNullChecks on
### Non-null Assertion Operator (Postfix !)
### Enums
### Less Common Primitives
#### bigint
#### symbol

# 3.Narrowing
## typeof type guards
## Truthiness narrowing
## Equality narrowing
## instanceof narrowing
## Assignments
## Control flow analysis
## Using type predicates
## Discriminated unions
## The never type
## Exhaustiveness checking

# 3.More on Functions
## Function Type Expressions
## Call Signatures
## Construct Signatures
## Generic Functions
## Inference
## Constraints
## Working with Constrained Values
## Specifying Type Arguments
## Guidelines for Writing Good Generic Functions
## Optional Parameters
## Optional Parameters in Callbacks
## Function Overloads
## Overload Signatures and the Implementation Signature
## Writing Good Overloads
## Declaring this in a Function
## Other Types to Know About
## void
## object
## unknown
## never
## Function
## Rest Parameters and Arguments
## Rest Parameters
## Rest Arguments
## Parameter Destructuring
## Assignability of Functions
## Return type void

