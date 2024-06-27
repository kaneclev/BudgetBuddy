
# DB planning
## Naive idea:
	- Make multiple tables for different users representing their fin info
		- WONT WORK because im treating tables like hashmaps which are like fully self contained k-v pairs which they are NOT 
## Refined idea:
	- For simplicity, we will assume each user can have a maximum of one budget at a time (so that we dont have to handle querying expenses via multiple budget ids etc.)
	- The users id will allow them to query fin info like expenses they have registered, goals, incomes, etc. 
	
