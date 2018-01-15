<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class FixedModelXml
 * @package Simulator\Model
 */
class FixedModelXml implements ModelXmlInterface
{
    /**
     * Returns the model xml as a string
     *
     * @return string
     */
    public function getAsString(): string
    {
        $model = <<<MODEL
<mujoco>
    <option timestep="0.001" viscosity="0.00002" density="1.2" gravity="0 0 -9.81" collision="dynamic" />
    <compiler coordinate="global" angle="degree"/>
    <default>
        <geom rgba=".8 .6 .4 1"/>
        <joint limited="true"/>
    </default>
    <asset>
        <texture type="skybox" builtin="gradient" rgb1="1 1 1" rgb2=".6 .8 1" width="256" height="256"/>
        <texture type="2d" name="checkers" builtin="checker" width="256" height="256" rgb1="0 0 0" rgb2="1 1 1" />
        <material name="checker_mat" texture="checkers" texrepeat="25 25"/>
    </asset>
    <visual>
        <global offwidth="800" offheight="800"/>
    </visual>
    <worldbody>
        <camera name='targeting' pos='1 1 2' mode='targetbodycom' target='body_0'/>

        <geom name="reference" pos="-120 0 0" size=".5 .5 .5" type="box" rgba="255 255 0 1"/>
        <geom name="floor" material="checker_mat" pos="0 0 -4" size="200 200 .125" rgba="1 1 1 1" type="plane" condim="3"/>
        <geom name="wall_1" type="box" pos="-10 38 -4" size="1 40 5"/>
        <geom name="wall_2" type="box" pos="-40 -42 -4" size="1 40 5"/>
        <geom name="wall_3" type="box" pos="-70 38 -4" size="1 40 5"/>
        <geom name="wall_4" type="box" pos="-100 -42 -4" size="1 40 5"/>

        <body name="body_0">
            <freejoint/>
            <site name="head" size="0.2 0.2 0.2" rgba="1 0 0 0.5"/>
            <geom name="geom_0" type="sphere" pos="0.00 0.00 0.20" size="0.3"/>
            <body name="body_1">
                <!--arms-->
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 0.00 0.00 1.00 1.00" size="0.100000"/>
                <geom name="geom_2" type="capsule" fromto="0.00 0.00 0.00 0.00 -1.00 1.00" size="0.100000"/>
                <!--spine-->
                <geom name="geom_3" type="capsule" fromto="0.00 0.00 0.00 8.00 0.00 0.00" size="0.100000"/>
                <!--arms-->
                <geom name="geom_4" type="capsule" fromto="4.00 0.00 0.00 4.00 1.00 1.00" size="0.100000"/>
                <geom name="geom_5" type="capsule" fromto="4.00 0.00 0.00 4.00 -1.00 1.00" size="0.100000"/>
                <!--arms-->
                <geom name="geom_20" type="capsule" fromto="8.00 0.00 0.00 8.00 1.00 1.00" size="0.100000"/>
                <geom name="geom_21" type="capsule" fromto="8.00 0.00 0.00 8.00 -1.00 1.00" size="0.100000"/>

            <!--first leg pair-->
                <!--upper leg-->
                <body name="body_2">
                    <joint type="hinge" pos="0 -1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_0"/>
                    <geom name="geom_6" type="capsule" fromto="0.00 -1.00 1.00 0.00 -2.00 1.00" size="0.100000"/>
                    <!--lower leg-->
                    <body name="body_3">
                        <joint type="hinge" pos="0 -2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_1"/>
                        <geom name="geom_7" type="capsule" fromto="0.00 -2.00 1.00 0.00 -3.00 -0.50" size="0.100000"/>
                    </body>
                </body>
                <!--upper leg-->
                <body name="body_4">
                    <joint type="hinge" pos="0 1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_2"/>
                    <geom name="geom_8" type="capsule" fromto="0.00 1.00 1.00 0.00 2.00 1.00" size="0.100000"/>
                    <!--lower leg-->
                    <body name="body_5">
                        <joint type="hinge" pos="0 2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_3"/>
                        <geom name="geom_9" type="capsule" fromto="0.00 2.00 1.00 0.00 3.00 -0.5" size="0.100000"/>
                    </body>
                </body>

            <!--second leg pair-->
                <!--upper leg-->
                <body name="body_6">
                    <joint type="hinge" pos="4 -1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_4"/>
                    <geom name="geom_10" type="capsule" fromto="4.00 -1.00 1.00 4.00 -2.00 1.00" size="0.100000"/>
                    <!--lower leg-->
                    <body name="body_7">
                        <joint type="hinge" pos="4 -2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_5"/>
                        <geom name="geom_11" type="capsule" fromto="4.00 -2.00 1.00 4.00 -3.00 -0.50" size="0.100000"/>
                    </body>
                </body>
                <!--upper leg-->
                <body name="body_8">
                    <joint type="hinge" pos="4 1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_6"/>
                    <geom name="geom_12" type="capsule" fromto="4.00 1.00 1.00 4.00 2.00 1.00" size="0.100000"/>
                    <!--lower leg-->
                    <body name="body_9">
                        <joint type="hinge" pos="4 2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_7"/>
                        <geom name="geom_13" type="capsule" fromto="4.00 2.00 1.00 4.00 3.00 -0.5" size="0.100000"/>
                    </body>
                </body>
            </body>

            <!--third leg pair-->
            <!--upper leg-->
            <body name="body_10">
                <joint type="hinge" pos="8 -1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_8"/>
                <geom name="geom_14" type="capsule" fromto="8.00 -1.00 1.00 8.00 -2.00 1.00" size="0.100000"/>
                <!--lower leg-->
                <body name="body_11">
                    <joint type="hinge" pos="8 -2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_9"/>
                    <geom name="geom_15" type="capsule" fromto="8.00 -2.00 1.00 8.00 -3.00 -0.50" size="0.100000"/>
                </body>
            </body>
            <!--upper leg-->
            <body name="body_12">
                <joint type="hinge" pos="8 1 1" axis="0 0 1" limited="true" range="-45 45" name="motor_10"/>
                <geom name="geom_16" type="capsule" fromto="8.00 1.00 1.00 8.00 2.00 1.00" size="0.100000"/>
                <!--lower leg-->
                <body name="body_13">
                    <joint type="hinge" pos="8 2 1" axis="1 0 0" limited="true" range="-20 45" name="motor_11"/>
                    <geom name="geom_17" type="capsule" fromto="8.00 2.00 1.00 8.00 3.00 -0.5" size="0.100000"/>
                </body>
            </body>
        </body>
    </worldbody>

    <actuator>
        <motor name="motor_0" joint="motor_0" gear="100"/>
        <motor name="motor_1" joint="motor_1" gear="100"/>
        <motor name="motor_2" joint="motor_2" gear="100"/>
        <motor name="motor_3" joint="motor_3" gear="100"/>
        <motor name="motor_4" joint="motor_4" gear="100"/>
        <motor name="motor_5" joint="motor_5" gear="100"/>
        <motor name="motor_6" joint="motor_6" gear="100"/>
        <motor name="motor_7" joint="motor_7" gear="100"/>
        <motor name="motor_8" joint="motor_8" gear="100"/>
        <motor name="motor_9" joint="motor_9" gear="100"/>
        <motor name="motor_10" joint="motor_10" gear="100"/>
        <motor name="motor_11" joint="motor_11" gear="100"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
