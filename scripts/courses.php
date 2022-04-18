<?php
function getUserCourses($conn, $userId): array
{
    $sql = "SELECT courseName,studentcourse.courseId FROM studentcourse INNER JOIN course ON studentcourse.courseId=course.courseId WHERE studentId=$userId AND courseApproved=1";
    $result = $conn->query($sql);
    $courses = [];
    if ($result->num_rows > 0) {
        while ($course = mysqli_fetch_assoc($result)) {
            $courses[$course["courseId"]] = $course["courseName"];
        }
    }
    return $courses;
}

function getAllLectures($conn, $courseId): array
{
    $sql = "SELECT lectureId,lectureDescription from lecture WHERE lecture.courseId=$courseId ORDER BY lecture.lectureId";
    $result = $conn->query($sql);
    $lectures = [];
    if ($result->num_rows > 0) {
        while ($lecture = $result->fetch_object()) {
            array_push($lectures, $lecture);
        }
    }
    return $lectures;
}

function getLectureResources($conn, $lectureId): array
{
    $sql = "SELECT * from lectureresource INNER JOIN file ON lectureresource.fileId=file.fileId WHERE lectureId=$lectureId";
    $result = $conn->query($sql);
    $resources = [];
    if ($result->num_rows > 0) {
        while ($file = $result->fetch_object()) {
            array_push($resources, $file);
        }
    }
    return $resources;
}

function getCourseInfo($conn, $courseId): object
{
    $sql = "SELECT courseName, courseProgramme FROM course WHERE courseId = $courseId";
    $res = $conn->query($sql);
    return $res->fetch_object();
}

?>