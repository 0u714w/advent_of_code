import re

def check_x(mat, i, j):
    # Construct the string from the positions around 'A'
    x_string = (
        mat[i-1][j-1] +  # Top Left
        mat[i][j] +      # Center A
        mat[i+1][j+1] +  # Bottom Right
        mat[i-1][j+1] +  # Top Right
        mat[i][j] +      # Center A again (for symmetry)
        mat[i+1][j-1]    # Bottom Left
    )
    
    # Check if the constructed string matches any valid X-MAS patterns
    return x_string in ["MASMAS", "SAMSAM", "SAMMAS", "MASSAM"]

def count_x_mas_patterns(mat):
    x_mas_count = 0
    rows, cols = len(mat), len(mat[0])
    
    for i in range(1, rows - 1):  # Avoid outermost rows
        for j in range(1, cols - 1):  # Avoid outermost columns
            if mat[i][j] == "A":
                x_mas_count += int(check_x(mat, i, j))
    
    return x_mas_count

def part_2(input_lines):
    mul_search = re.compile(r"mul\(([0-9]{1,3}),([0-9]{1,3})\)")
    
    merged_data = "".join([line.strip() for line in input_lines])
    
    dirty_processing = [segment.split("don't()")[0] for segment in merged_data.split("do()")]
    
    results = mul_search.findall("".join(dirty_processing))
    
    sum_of_multiples = sum(int(x) * int(y) for x, y in results)

    # Extracting the grid from input_lines (assuming each line is a row)
    matrix = [list(line.strip()) for line in input_lines if line.strip()] 

    # Count X-MAS patterns in the extracted grid
    x_mas_count = count_x_mas_patterns(matrix)

    return sum_of_multiples, x_mas_count

# Example usage:
with open("sample.txt", "r") as file:
    input_lines = file.readlines()

sum_of_multiples, x_mas_count = part_2(input_lines)
print(f"Sum of multiples: {sum_of_multiples}, X-MAS patterns found: {x_mas_count}")