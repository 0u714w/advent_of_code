from collections import Counter

def calculate_total_distance(left_list, right_list):
    left_sorted = sorted(left_list)
    right_sorted = sorted(right_list)
    total_distance = sum(abs(a - b) for a, b in zip(left_sorted, right_sorted))
    return total_distance

def calculate_similarity_score(left_list, right_list):
    right_counter = Counter(right_list)
    similarity_score = sum(num * right_counter[num] for num in left_list)
    return similarity_score

with open('input.txt', 'r') as file:
    lines = file.readlines()

left_list = []
right_list = []

for line in lines:
    left, right = map(int, line.strip().split())
    left_list.append(left)
    right_list.append(right)

distance_result = calculate_total_distance(left_list, right_list)
similarity_result = calculate_similarity_score(left_list, right_list)

print(f"The total distance between the lists is: {distance_result}")
print(f"The similarity score between the lists is: {similarity_result}")