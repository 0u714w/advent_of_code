import re

def solve_puzzle(memory):
    if isinstance(memory, list):
        memory = ''.join(memory)
    
    # Patterns for instructions
    mul_pattern = r'mul\((\d{1,3}),(\d{1,3})\)'
    do_pattern = r'do\(\)'
    dont_pattern = r"don't\(\)"
    
    instructions = re.finditer(f'{mul_pattern}|{do_pattern}|{dont_pattern}', memory)
    
    total = 0
    enabled = True
    
    for instruction in instructions:
        if instruction.group() == 'do()':
            enabled = True
        elif instruction.group() == "don't()":
            enabled = False
        elif enabled:
            x, y = map(int, instruction.groups())
            total += x * y
    
    return total

# Example usage
with open('memory.txt', 'r') as file:
    corrupted_memory = file.readlines()

result = solve_puzzle(corrupted_memory)
print(f"The sum of all enabled multiplication results is: {result}")